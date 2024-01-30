<?php
class Template{
    protected $_ci;
     
    function __construct(){
        $this->_ci = &get_instance();
    }
     
    function view($content, $data = NULL){
        /*
         * $data['headernya'] , $data['contentnya'] , $data['footernya']
         * variabel diatas ^ nantinya akan dikirim ke file views/template/index.php
         * */
        $data['head']          = $this->_ci->load->view('template/head', $data, TRUE);        
        $data['header']        = $this->_ci->load->view('template/header', $data, TRUE);        
        $data['sidebar']       = $this->_ci->load->view('template/sidebar', $data, TRUE);
        $data['content']       = $this->_ci->load->view($content, $data, TRUE);
        $data['right_sidebar'] = $this->_ci->load->view('template/right_sidebar', $data, TRUE);  
        $data['footer']        = $this->_ci->load->view('template/footer', $data, TRUE);
        $data['footer_js']     = $this->_ci->load->view('template/footer_js', $data, TRUE);
        $this->_ci->load->view('admin/template', $data);
    }
}