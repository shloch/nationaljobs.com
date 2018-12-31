<?php

class Mcompany extends CI_Model {

    var $table = 'kj_member';
    var $CompanyDetailTable = 'kj_company_details';
    var $CompanyCategories = 'kj_industry_type';
    var $associateJobToCategoryTable = 'kj_jobs_and_their_categories';
    var $jobTable = 'kj_job';
    var $memberTable = 'kj_member';
    var $jobCategoryTable = 'kj_job_category';
    var $jobAppliedFor = 'kj_job_applied_for';
    var $documentTable = 'kj_documents';
    var $type_of_document = 'kj_type_of_document';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    public function findByMemberId($member_id) {
        $this->db->select('*');
        $this->db->where('member_id', $member_id);
        $this->db->from($this->CompanyDetailTable);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }

    function associateJobToCategory($companyID, $categorieID) {
        $data2 = array(
            'companyID' => $companyID,
            'categorieID' => $categorieID
        );
        $this->db->insert($this->associateJobToCategoryTable, $data2);
    }

    function deleteJob($jobID) {
        $this->db->where('job_id', $jobID);
        $this->db->delete($this->jobTable);
    }

    function selectJobByID($jobID) {
        $this->db->select('*');
        $this->db->where('job_id', $jobID);
        $this->db->from($this->jobTable);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }

    function selectAllJobsByCompany($companyID) {
        $this->db->select('*');
        $this->db->where('owner', $companyID);
        $this->db->from($this->jobTable);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result();
            return $results;
        } else {
            return FALSE;
        }
    }

    function addNewJob($owner, $jobDescription, $jobTitle, $deadline = NULL, $jobSkills, $specialTraining = NULL, $contractType, $educationRequired) {
        $data2 = array(
            'description' => $jobDescription,
            'title' => $jobTitle,
            'deadline' => $deadline,
            'job_registration_date' => time(),
            'owner' => $owner,
            'skills' => $jobSkills,
            'special_training' => $specialTraining,
            'contract_type' => $contractType,
            'education_requirement' => $educationRequired
        );
        $this->db->insert($this->jobTable, $data2);
    }

    function selectAllCompanyCategories() {
        $this->db->select('*');
        return $query = $this->db->get($this->CompanyCategories);
    }

    function selectCompanyDetails($companyID) {

//        $sql = "SELECT 
//                    kj_company_details.company_details_id,
//                    kj_company_details.id_member,
//                    kj_company_details.industry_type_id,
//                    kj_company_details.portrait,
//                    kj_company_details.name_of_hiring_personnal AS companyHiringPersonel,
//                    kj_company_details.date_of_company_creation AS companyCreationDate,
//                    kj_industry_type.industryTypeID,
//                    kj_industry_type.industry_type_categories AS companyCategory,
//                    kj_member.member_id
//                  FROM
//                    kj_company_details
//                    INNER JOIN kj_member ON (kj_company_details.id_member = kj_member.member_id)
//                    INNER JOIN kj_industry_type ON (kj_company_details.industry_type_id = kj_industry_type.industryTypeID)
//                  WHERE
//                    kj_member.member_id = 5";       
//        $query = $this->db->query($sql);
        $data = array(
            $this->CompanyDetailTable . '.company_details_id',
            $this->CompanyDetailTable . '.member_id',
            $this->CompanyDetailTable . '.industry_type_id',
            $this->CompanyDetailTable . '.portrait',
            $this->CompanyDetailTable . '.name_of_hiring_personnel',
            $this->CompanyDetailTable . '.date_of_company_creation',
            $this->CompanyCategories . '.industryTypeID',
            $this->CompanyCategories . '.industry_type_categories',
            $this->table . '.member_id'
        );

        $this->db->select($data);
        $this->db->from($this->CompanyDetailTable);
        $this->db->join($this->table, $this->CompanyDetailTable . '.member_id = ' . $this->table . '.member_id', 'inner');
        $this->db->join($this->CompanyCategories, $this->CompanyDetailTable . '.industry_type_id = ' . $this->CompanyCategories . '.industryTypeID', 'inner');
        $this->db->where($this->table . '.member_id', $companyID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row[0];
        } else {
            return FALSE;
        }
    }

    function addCompanyInformations($companyType, $companyCreationDate, $nameHiringPersonnal, $portrait, $member_id) {
        $data2 = array(
            'industry_type_id' => $companyType,
            'date_of_company_creation' => $companyCreationDate,
            'name_of_hiring_personnel' => $nameHiringPersonnal,
            'portrait' => $portrait
        );
        $this->db->where('member_d', $member_id);
        $this->db->insert($this->CompanyDetailTable, $data2);
    }

    function editCompanyInformations($companyType, $companyCreationDate, $nameHiringPersonnal, $portrait, $member_id) {

        $data2 = array(
            'industry_type_id' => $companyType,
            'date_of_company_creation' => $companyCreationDate,
            'name_of_hiring_personnel' => $nameHiringPersonnal,
            'portrait' => $portrait
        );
        $this->db->where('member_id', $member_id);
        $this->db->update($this->CompanyDetailTable, $data2);
    }

    /**
     * 
     * @param type $jobID
     * @param type $companyID  //a company is a member on the site, this field therefore comes from "member_id"
     * @return boolean  //comes from table "kj_industry_type"
     */
    function selectPresentJobCategories($jobID, $companyID) {
        $this->db->select('*');
        $this->db->where('companyID', $companyID);
        $this->db->from($this->associateJobToCategoryTable);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
            return $results;
        } else {
            return FALSE;
        }
    }

    function emptyJobAndCategorie($companyID) {
        $this->db->where('companyID', $companyID);
        $this->db->delete($this->associateJobToCategoryTable);
    }

    function addEditedJob($jobID, $memberID, $jobDescription, $jobTitle, $deadline, $jobSkills, $jobSpecialTraining, $contractType, $educationRequirement) {
        $data2 = array(
            'description' => $jobDescription,
            'title' => $jobTitle,
            'deadline' => $deadline,
            'job_registration_date' => time(),
            'owner' => $memberID,
            'skills' => $jobSkills,
            'special_training' => $jobSpecialTraining,
            'contract_type' => $contractType,
            'education_requirement' => $educationRequirement
        );
        $this->db->where('job_id', $jobID);
        $this->db->update($this->jobTable, $data2);
    }

    //yousilb
    public function searchJobs($jobTitle, $jobState, $jobCountry, $jobCity, $start = null, $end = null, $count = false) {
        $data = array(
            $this->memberTable . '.member_id AS owner',
            $this->memberTable . '.username',
            $this->memberTable . '.username',
            $this->memberTable . '.name',
            $this->memberTable . '.photo',
            $this->jobTable . '.description',
            $this->jobTable . '.title',
            $this->jobTable . '.deadline',
            $this->jobTable . '.job_registration_date',
            $this->jobTable . '.skills',
            $this->jobTable . '.special_training',
            $this->jobTable . '.visit_counter',
            $this->jobTable . '.contract_type',
            $this->jobTable . '.education_requirement',
            $this->jobTable . '.state',
            $this->jobTable . '.country',
            $this->jobTable . '.city_or_zip',
            $this->jobTable . '.job_id',
            $this->jobTable . '.salary_range',
            $this->jobTable . '.year_of_experience',
            $this->jobCategoryTable . '.job_category_id',
            $this->jobCategoryTable . '.title AS category_title'
        );

        $this->db->select($data);
        $this->db->order_by("job_registration_date", "desc");

        $this->db->from($this->jobTable);
        $this->db->join($this->memberTable, $this->jobTable . '.owner = ' . $this->memberTable . '.member_id', 'inner');
        $this->db->join($this->jobCategoryTable, $this->jobTable . '.job_category_id = ' . $this->jobCategoryTable . '.job_category_id', 'inner');

        if ($jobCity != "") {
            $where = "$this->jobTable.city_or_zip = '$jobCity'";
            $this->db->where($where);
        }
        if ($jobState != "") {
            $where = "$this->jobTable.state = '$jobState'";
            $this->db->where($where);
        }
        if ($jobCountry != "") {
            $where = "$this->jobTable.country = '$jobCountry'";
            $this->db->where($where);
        }

        if ($jobTitle != "") {
            $where = "($this->jobTable.description LIKE '%$jobTitle%' OR $this->jobTable.skills LIKE '%$jobTitle%' 
                    OR $this->jobTable.special_training LIKE '%$jobTitle%' OR $this->jobTable.title LIKE '%$jobTitle%')";
            $this->db->where($where);
        }
        if ($count) {
            return $this->db->count_all_results();
        }
        //pagination elements
        if ($start === null) {
            if ($end === null)
                $select = " ";
            else {
                if (!is_numeric($end))
                    throw new Exception('maxByPage must be an integer value');
                $this->db->limit($end);
            }
        }
        if ($start !== null) {
            if ($end === null)
                throw new Exception("if firstIdToShow is provided, the  maxByPage must be to");
            if (!is_numeric($end))
                throw new Exception('maxByPage must be an integer value');
            if (!is_numeric($start))
                throw new Exception('firstIdToShow must be an integer value');
            $this->db->limit($end, $start); // Produces: LIMIT $start, $end (in MySQL. Other databases have slightly different syntax)
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rows = array();
            foreach ($query->result_array() as $row) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array(); //an empty array
        }
    }

    public function searchJobstoArray($job_id, $description, $title, $deadline, $job_registration_date, $member_id, $skills, $special_training, $visit_counter, $job_category_id, $contract_type, $education_requirement, $state, $photo, $country, $city_or_zip, $username, $category_title, $salary_range, $year_of_experience, $name) {
        $var = array('job_id' => $job_id, 'description' => $description, 'title' => $title, 'deadline' => $deadline,
            'job_registration_date' => $job_registration_date, 'member_id' => $member_id, 'skills' => $skills, 'special_training' => $special_training,
            'visit_counter' => $visit_counter, 'job_category_id' => $job_category_id, 'contract_type' => $contract_type, 'education_requirement' => $education_requirement,
            'state' => $state, 'photo' => $photo, 'country' => $country, 'city_or_zip' => $city_or_zip, 'username' => $username, 'category_title' => $category_title
            , 'salary_range' => $salary_range, 'year_of_experience' => $year_of_experience, 'name' => $name);
        return $var;
    }

    public function searchJobsToJson($job_id, $description, $title, $deadline, $job_registration_date, $member_id, $skills, $special_training, $visit_counter, $job_category_id, $contract_type, $education_requirement, $state, $photo, $country, $city_or_zip, $username, $category_title, $salary_range, $year_of_experience, $name) {
        $return = json_encode($this->searchJobstoArray($job_id, $description, $title, $deadline, $job_registration_date, $member_id, $skills, $special_training, $visit_counter, $job_category_id, $contract_type, $education_requirement, $state, $photo, $country, $city_or_zip, $username, $category_title, $salary_range, $year_of_experience, $name));
        return $return;
    }

    public function fetchJobCategories() {
        $this->db->select('*');
        $this->db->from($this->jobCategoryTable);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rows = array();
            foreach ($query->result_array() as $row) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return array(); //an empty array
        }
    }

    public function findJobById($job_id) {
        $data = array(
            $this->memberTable . '.member_id AS owner',
            $this->memberTable . '.username',
            $this->memberTable . '.name',
            $this->memberTable . '.photo',
            $this->jobTable . '.description',
            $this->jobTable . '.title',
            $this->jobTable . '.deadline',
            $this->jobTable . '.job_registration_date',
            $this->jobTable . '.skills',
            $this->jobTable . '.special_training',
            $this->jobTable . '.visit_counter',
            $this->jobTable . '.contract_type',
            $this->jobTable . '.education_requirement',
            $this->jobTable . '.state',
            $this->jobTable . '.country',
            $this->jobTable . '.city_or_zip',
            $this->jobTable . '.job_id',
            $this->jobTable . '.salary_range',
            $this->jobTable . '.year_of_experience',
            $this->jobCategoryTable . '.job_category_id',
            $this->jobCategoryTable . '.title AS category_title'
        );

        $this->db->select($data);
        $this->db->from($this->jobTable);
        $this->db->join($this->memberTable, $this->jobTable . '.owner = ' . $this->memberTable . '.member_id', 'inner');
        $this->db->join($this->jobCategoryTable, $this->jobTable . '.job_category_id = ' . $this->jobCategoryTable . '.job_category_id', 'inner');

        $this->db->where('job_id', $job_id);
        ;

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return FALSE;
        }
    }

    function applyToTheJob($job_id, $member_id, $date) {
        $this->output->enable_profiler(TRUE);
        $this->db->set('job_id', $job_id);
        $this->db->set('member_id', $member_id);
        $this->db->set('application_date', $date);
        $this->db->insert($this->jobAppliedFor);
        return $this->db->insert_id();
    }

    function checkIfMemberAlreadyAppliedForTheJob($memberID, $jobID) {
        $this->db->select('*');
        $this->db->from($this->jobAppliedFor);
        $this->db->where('job_id', $jobID);
        $this->db->where('member_id', $memberID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
            return $results;
        } else {
            return FALSE;
        }
    }

    public function fetchJobAppliedFor($member_id) {
        $data = array(
            $this->memberTable . '.member_id AS owner',
            $this->memberTable . '.name',
            $this->jobTable . '.title',
            $this->jobTable . '.deadline',
            $this->jobTable . '.job_registration_date',
            $this->jobTable . '.contract_type',
            $this->jobTable . '.job_id',
            $this->jobAppliedFor . '.job_applied_for_id',
            $this->jobAppliedFor . '.application_date'
        );

        $this->db->select($data);
        $this->db->from($this->memberTable);
        $this->db->join($this->jobTable, $this->memberTable . '.member_id = ' . $this->jobTable . '.owner', 'inner');
        $this->db->join($this->jobAppliedFor, $this->jobTable . '.job_id = ' . $this->jobAppliedFor . '.job_id', 'inner');

        $this->db->where($this->jobAppliedFor . '.member_id', $member_id);
        

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return FALSE;
        }
    }

    public function jobSearchAutocomplete($element, $part) {
        switch ($element) {
            case 'title':
                $data = array(
                    $this->jobTable . '.title AS matched_element'
                    );
                $this->db->or_like('title', $part);
                $this->db->or_like('description', $part);
                $this->db->or_like('skills', $part);
                $this->db->order_by("title", "asc");
                break;
            case 'state':
                $data = array(
                    $this->jobTable . '.state AS matched_element'
                    );
                $this->db->like('state', $part);
                $this->db->order_by("state", "asc");
                break;
            case 'country':
                $data = array(
                    $this->jobTable . '.country AS matched_element'
                    );
                $this->db->like('country', $part);
                $this->db->order_by("country", "asc");
                break;
            case 'city':
                $data = array(
                    $this->jobTable . '.city_or_zip AS matched_element'
                    );
                $this->db->like('city_or_zip', $part);
                $this->db->order_by("city_or_zip", "asc");
                break;
            default :
                $data = array(
                    $this->jobTable . '.title AS matched_element'
                    );
                $this->db->like('title', $part);
                $this->db->order_by("title", "asc");
                break;
        }
        
        $this->db->select($data);
        $this->db->distinct();
        $this->db->from($this->jobTable);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return FALSE;
        }
    }
    function findDocumentTypeByExtension($extension) {
        $this->db->select('*');
        $this->db->where('type', $extension);
        $this->db->from($this->type_of_document);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } else {
            return FALSE;
        }
    }
    function addDocument($document_name, $new_name, $member_id, $type_of_document_id) {
        $this->db->set('document_name', $document_name);
        $this->db->set('document_url', $new_name);
        $this->db->set('owner', $member_id);
        $this->db->set('creation_date', time());
        $this->db->set('type_of_document_id', $type_of_document_id);
        $this->db->insert($this->documentTable);
        return $this->db->insert_id();
    }
    
    //end yousilb
}

/* End of file mstudent.php */
/* Location: ./system/application/models/mstudent.php */
