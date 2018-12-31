<?php

/*
 * form validation rules for KIMBER JOB PROJECTS
 */

$config = array(
    'searchJob' => array(
        array(
            'field' => 'jobTitle',
            'label' => 'jobTitle',
            'rules' => 'trim|max_length[100]'
        ),
        array(
            'field' => 'jobState',
            'label' => 'jobState',
            'rules' => 'trim|max_length[100]'
        ),
        array(
            'field' => 'jobCity',
            'label' => 'jobCity',
            'rules' => 'trim|max_length[100]'
        ),
        array(
            'field' => 'jobCountry',
            'label' => 'jobCountry',
            'rules' => 'trim|max_length[100]'
        ),
        array(
            'field' => 'lastElement',
            'label' => 'lastElement',
            'rules' => 'required|integer|greater_than[0]'
        )
    ),
    'addProfessionnalTraining' => array(
        array(
            'field' => 'trainer',
            'label' => 'Trainer',
            'rules' => 'required|trim|max_length[100]'
        ),
        array(
            'field' => 'training_period',
            'label' => 'Training Period',
            'rules' => 'required|trim|max_length[50]'
        ),
        array(
            'field' => 'certificate_obtened',
            'label' => 'Certificate Obtened',
            'rules' => 'trim|max_length[100]'
        )
    ),
    'addReference' => array(
        array(
            'field' => 'reference',
            'label' => 'Reference',
            'rules' => 'required|trim|max_length[200]'
        )
    ),
    'addWorkHistory' => array(
        array(
            'field' => 'company_name',
            'label' => 'Company Name',
            'rules' => 'required|trim|max_length[100]'
        ),
        array(
            'field' => 'company_address',
            'label' => 'Company Address',
            'rules' => 'trim|max_length[100]'
        ),
        array(
            'field' => 'start_date',
            'label' => 'Start Date',
            'rules' => 'required|trim|max_length[10]'
        ),
        array(
            'field' => 'end_date',
            'label' => 'End Date',
            'rules' => 'required|trim|max_length[10]'
        ),
        array(
            'field' => 'job_description',
            'label' => 'Job Description',
            'rules' => 'required|trim|max_length[1000]'
        )
    ),
    'addJob' => array(
        array(
            'field' => 'jobTitle',
            'label' => 'Job title',
            'rules' => 'required|trim|htmlspecialchars'
        ),
        array(
            'field' => 'jobDescription',
            'label' => 'Job Desciption',
            'rules' => 'required|trim|htmlspecialchars'
        ),
        array(
            'field' => 'jobSkills',
            'label' => 'Job Skills',
            'rules' => 'required|trim|htmlspecialchars'
        ),
        array(
            'field' => 'companyCategorie',
            'label' => 'Company Type',
            'rules' => 'required'
        ),
        array(
            'field' => 'contractType',
            'label' => 'Contract Type',
            'rules' => 'required|trim|htmlspecialchars'
        ),
        array(
            'field' => 'educationRequirement',
            'label' => 'Qualifications needed',
            'rules' => 'required|trim|htmlspecialchars'
        )
    ),
    'reinitializePasswd' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[50]'
        )
    ),
    'addAward' => array(
        array(
            'field' => 'title',
            'label' => 'Award title',
            'rules' => 'required|trim|max_length[100]'
        ),
        array(
            'field' => 'issuing_organization',
            'label' => 'Organization',
            'rules' => 'required|trim|max_length[200]'
        ),
        array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'required|trim|max_length[10]'
        ),
        array(
            'field' => 'place',
            'label' => 'Place',
            'rules' => 'required|trim|max_length[200]'
        ),
        array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required|trim|max_length[200]'
        )
    ),
    'editSkills' => array(
        array(
            'field' => 'title',
            'label' => 'Your Skills',
            'rules' => 'trim|max_length[1000]'
        )
    ),
    'editLinks' => array(
        array(
            'field' => 'facebook',
            'label' => 'Your Facebook link',
            'rules' => 'trim|max_length[50]'
        ),
        array(
            'field' => 'twitter',
            'label' => 'Your Twitter link',
            'rules' => 'trim|max_length[50]'
        ),
        array(
            'field' => 'linkedIn',
            'label' => 'Your LinkedIn link',
            'rules' => 'trim|max_length[50]'
        )
    ),
    'editCompanyInformations' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|max_length[99]'
        ),
        array(
            'field' => 'companyCreationDate',
            'label' => 'Date of birthday',
            'rules' => 'trim|max_length[10]'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|max_length[7]|alpha'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[30]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[50]'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'trim|numeric|max_length[30]'
        )
    ),
    'editPersonalInformations' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|max_length[99]'
        ),
        array(
            'field' => 'dob',
            'label' => 'Date of birthday',
            'rules' => 'trim|max_length[10]'
        ),
        array(
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'trim|max_length[7]|alpha'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[30]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[50]'
        ),
        array(
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'trim|numeric|max_length[30]'
        )
    ),
    'signup' => array(
        array(
            'field' => 'access_level_id',
            'label' => 'Account Type',
            'rules' => 'required|greater_than[0]|less_than[3]'
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[30]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'alpha_numeric|required|min_length[7]|matches[password_confirmation]|'
        ),
        array(
            'field' => 'password_confirmation',
            'label' => 'Password Confirmation',
            'rules' => 'alpha_numeric|required|min_length[7]|'
        ),
        array(
            'field' => 'agree_tos',
            'label' => 'TERMS OF SERVICE',
            'rules' => 'required'
        ),
        array(
            'field' => 'captchaInput',
            'label' => 'CAPTCHA',
            'rules' => 'required|matches[captchaWord]|'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[50]'
        )
    ),
    'login' => array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'alpha_numeric|required|min_length[7]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|max_length[50]'
        )
    ),
    'change_password' => array(
        array(
            'field' => 'current_password',
            'label' => 'Current Password',
            'rules' => 'alpha_numeric|required|min_length[7]'
        ),
        array(
            'field' => 'password',
            'label' => 'New Password',
            'rules' => 'alpha_numeric|required|min_length[7]|matches[password_confirmation]|'
        ),
        array(
            'field' => 'password_confirmation',
            'label' => 'Password Confirmation',
            'rules' => 'alpha_numeric|required|min_length[7]|'
        )
    ),
    'email' => array(
        array(
            'field' => 'emailaddress',
            'label' => 'EmailAddress',
            'rules' => 'required|valid_email|min_length[50]'
        ),
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|alpha'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'message',
            'label' => 'MessageBody',
            'rules' => 'required'
        )
    )
);
?>
