<?php

/*
 * controller to manage serach results & results filtering
 */

class JobSearch extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Mcompany', 'company');
        $this->load->model('Muser', 'user');
        $this->load->helper('file');
    }

    function index() {
        $data['title'] = "Job Search Results";
        $data['include'] = "jobSearchResults/index.php";
        $accountType = 2; //for company
        $companies = $this->user->fetchUserByType($accountType);
        $this->session->set_userdata('companies', $companies);
        $jobCategories = $this->company->fetchJobCategories();
        $this->session->set_userdata('jobCategories', $jobCategories);
        $this->load->view('template_search', $data);
    }

    function jobDetails($jobId, $jobTitle) {
        if (!is_numeric($jobId)) {
            redirect('/jobSearch/index');
        }
        //find job in the database
        $job = $this->company->findJobById($jobId);
        if (!$job) {
            //no job found with this ID
            redirect('/jobSearch/index');
        }
        //update view counter
        //.....
        $job = $job[0];
        $data['title'] = "Job Details: " . $job['title'];
        $data['include'] = "jobDetails.php";
        $this->session->set_userdata('choosen_job', $job);

        $accountType = 2; //for company
        $companies = $this->user->fetchUserByType($accountType);
        $this->session->set_userdata('companies', $companies);
        $jobCategories = $this->company->fetchJobCategories();
        $this->session->set_userdata('jobCategories', $jobCategories);

        $logged = $this->session->userdata('member_id');
        if (($logged !== FALSE)) {
            $job = $this->company->checkIfMemberAlreadyAppliedForTheJob($logged, $jobId);
            if ($job !== false) {
                //You have already applied for this job
                $this->session->set_userdata('alreadyApply', true);
            } else {
                $this->session->set_userdata('alreadyApply', false);
            }
        }

        $this->load->view('template_search', $data);
    }

    function apply() {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => '1', 'Message' => 'Please LogIn to apply to this job, or register first.')));
        }
        if (isset($_POST)) {
            extract($_POST);
            if (!is_numeric($jobId)) {
                redirect('/jobSearch/index');
            }
            //find job in the database
            $job = $this->company->findJobById($jobId);
            if (!$job) {
                //no job found with this ID
                redirect('/jobSearch/index');
            }
            //find by jobId and memberId
            $job = $this->company->checkIfMemberAlreadyAppliedForTheJob($logged, $jobId);
            if ($job !== false) {
                //jobApliedFor found
                die(json_encode(array('Error' => '1', 'Message' => 'You have already applied for this job.')));
            }
            //we save informations in the database, apply to the job provided
            $result = $this->company->applyToTheJob($jobId, $logged, time());

            die(json_encode(array('Error' => 0, 'Message' => 'Your application has been received.')));
        } else {
            redirect('/jobSearch/index');
        }
    }

    function search() {
        if (isset($_POST)) {
            if ($this->form_validation->run('searchJob') == FALSE) {
                die(json_encode(array('Error' => 1, 'Message' => 'Please fill the form properly.')));
            } else {
                extract($_POST);
                //let get it started
                //we run the search now
                //the limit will be 50   

                $totalToShow = 2; //just to see how it wiil be shown, we will make it work properly in the search later while accesssing to the database                      
                $page = ($lastElement > 1) ? $lastElement : 1; //mean that we are on the first page, the first request
                $start = ($page - 1) * $totalToShow;
                $start = '' . $start . '';
                $totalJobsForTheSearch = $this->company->searchJobs($jobTitle, $jobState, $jobCountry, $jobCity, null, null, true);
                $js_jobs_array = '
                <script type="text/javascript">
                    $(function(){        
                        njl.tempCollector= [];
                    });    
                </script>';
                if ($totalJobsForTheSearch == 0)
                    die(json_encode(array('Data' => $js_jobs_array, 'Error' => 0, 'Message' => 'No Jobs for the moment', 'MaxResultByPage' => $totalToShow)));
                //we got the results, now we have to...
                //now we take datas
                $jobs = $this->company->searchJobs($jobTitle, $jobState, $jobCountry, $jobCity, $start, $totalToShow);
                //send back the results in an array of  javascript's object, into jasonFormat
                $js_jobs_array = '';
                $jobsStrinFormatForTheCookie = '';
                $position = $totalToShow;
                foreach ($jobs as $job) {
                    $js_jobs_array .= "," . $this->company->searchJobsToJson($job['job_id'], $job['description'], $job['title'], date('Y-m-d', $job['deadline']), date('Y-m-d', $job['job_registration_date']), $job['owner'], $job['skills'], $job['special_training'], $job['visit_counter'], $job['job_category_id'], $job['contract_type'], $job['education_requirement'], $job['state'], $job['photo'], $job['country'], $job['city_or_zip'], $job['username'], $job['category_title'], $job['salary_range'], $job['year_of_experience'], $job['name']);
                    $jobsStrinFormatForTheCookie .= "|" . $job['job_id'] . "@_@" . $job['description'] . "@_@" . $job['title'] . "@_@" . date('Y-m-d', $job['deadline']) . "@_@" . date('Y-m-d', $job['job_registration_date']) . "@_@" . $job['owner'] . "@_@" . $job['skills'] . "@_@" . $job['special_training'] . "@_@" . $job['visit_counter'] . "@_@" . $job['job_category_id'] . "@_@" . $job['contract_type'] . "@_@" . $job['education_requirement'] . "@_@" . $job['state'] . "@_@" . $job['photo'] . "@_@" . $job['country'] . "@_@" . $job['city_or_zip'] . "@_@" . $job['username'] . "@_@" . $job['category_title'] . "@_@" . $job['salary_range'] . "@_@" . $job['year_of_experience'] . "@_@" . $job['name'];
                    $position--;
                }
                $js_jobs_array_first = '';
                $nextPage = $lastElement + 1;
                $lastElement = ($lastElement * $totalToShow) - $position;

                $js_jobs_array = '[' . substr($js_jobs_array_first . $js_jobs_array, 1) . ']';
                $jobsStrinFormatForTheCookie = substr($jobsStrinFormatForTheCookie, 1);
                $pages = ceil($totalJobsForTheSearch / $totalToShow);
                $total = $totalJobsForTheSearch;
                $js_jobs_array = '
                <script type="text/javascript">
                    $(function(){        
                        njl.tempCollector= ' . $js_jobs_array . ';
                    });    
                </script>';
                $message = "Showing " . $lastElement . " of " . number_format($total) . " Job(s) for your search";

                die(json_encode(array('Data' => $js_jobs_array, 'Error' => 0, 'Message' => $message, 'TotalResults' => $total, 'Pages' => $pages, 'NextPage' => $nextPage, 'JobsStrinFormatForTheCookie' => $jobsStrinFormatForTheCookie)));
            }
        } else {
            redirect('/jobSearch/index');
        }
    }

    function jobAppliedFor() {
        $logged = $this->session->userdata('member_id');
        if (isset($logged) && $logged != FALSE) {
            $data['title'] = "Jobs Applied For";
            $data['include'] = "editProfile/user/job_applied_for.php";

            $this->load->view('template2', $data);
        } else {
            $this->login_page();
        }
    }

    function refreshJobAppliedForList($personalMessage = null) {
        $logged = $this->session->userdata('member_id');
        if (($logged == FALSE)) {
            die(json_encode(array('Error' => 404, 'Message' => 'Your session has expired. Please signIn again.')));
        }
        $jobsAppliedFor = $this->company->fetchJobAppliedFor($logged);
        $this->session->set_userdata('jobAppliedFor', $jobsAppliedFor);
        echo '<table cellpadding="0" cellspacing="0" border="0" class="display" id="jobAppliedForTableList">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Dead Line</th>
                            <th>Contract Type</th>
                            <th>Application Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Dead Line</th>
                            <th>Contract Type</th>
                            <th>Application Date</th>
                        </tr>
                    </tfoot>
                    <tbody>';
        foreach ($jobsAppliedFor as $jobAppliedFor) {
            echo' <tr class="gradeA" rel="' . $jobAppliedFor['job_applied_for_id'] . '">
                    <td><a href="' . base_url() . 'index.php/jobSearch/jobDetails/' . $jobAppliedFor['job_id'] . '/' . (stripslashes($jobAppliedFor['title'])) . '"  title="details" >' . stripslashes($jobAppliedFor['title']) . '</a></td>                    
                    <td>' . stripslashes($jobAppliedFor['name']) . '</td>                    
                    <td>' . date('Y-m-d', $jobAppliedFor['job_registration_date']) . '</td>                    
                    <td>' . date('Y-m-d', $jobAppliedFor['deadline']) . '</td>                    
                    <td>' . stripslashes($jobAppliedFor['contract_type']) . '</td>                    
                    <td>' . date('Y-m-d H:m', $jobAppliedFor['application_date']) . '</td>                    
                </tr>';
        }
        echo '
    </tbody>
    </table>
    <script type="text/javascript">
        $(function(){        
            var oTable = $(\'#jobAppliedForTableList\').dataTable( {
                "sDom": \'T<"clear">lfrtip\',
                "oTableTools": {
                    "sRowSelect": "uni",
                    "aButtons": [ "select_all", "select_none" ]
                },
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
            });  
        });    
    </script>';
    }

    function autocomplete($operation) {
        extract($_GET);
        if (isset($term) and $term != '') {
            $part = remove_accent(trim($term));
            // initialize the results array
            $results = array();
            $matched_elements = $this->company->jobSearchAutocomplete(trim($operation), $part);
            if ($matched_elements !== false) {
                foreach ($matched_elements as $matched_element) {
                    $results[] = $matched_element['matched_element'];
                }
                // return the array as json
                die(json_encode($results));
            }
        }
    }

}

function remove_accent($str) {
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð',
        'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã',
        'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ',
        'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ',
        'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę',
        'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī',
        'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ',
        'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',
        'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť',
        'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ',
        'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ',
        'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O',
        'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
        'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u',
        'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D',
        'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g',
        'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K',
        'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o',
        'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
        's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W',
        'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
        'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    return str_replace($a, $b, $str);
}