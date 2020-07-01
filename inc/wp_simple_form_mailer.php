<?php
/**
 * Class Name: PG_Simple_Form_Mailer
 * GitHub URI:
 * Description:
 * Version: 1.0
 * Author: Matjaz Trontelj - @pinegrow
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */


class PG_Simple_Form_Mailer {

    public $processed = false;
    public $error = true;
    public $message = 'The form was not submitted';
    public $text = null;
    public $html = null;

    public function process( $arg_options = array() ) {

        $admin_email = get_option('admin_email');

        $options = array(
            'form_id' => 'contact_form',
            'send_to_email' => false,
            'email' => $admin_email,
            'title' => 'Contact form submission',
            'intro' => 'We received a new contact form submission:',
            'save_to_post_type' => null,
            'post_type' => null,
            'captcha' => false,
            'captcha_key' => null,
            'captcha_secret' => null,
            'log_ip' => true,
            'success_message' => 'Thank you for getting in touch!',
            'error_message' => 'There was a problem submitting this form. Please contact us directly.'
        );

        //merge options
        foreach($arg_options as $key => $value) {
            $options[ $key ] = $value;
        }

        if( !empty($_POST[$options['form_id']]) ) {
            //the form was submitted
            //we assume the browser did the validation
            $lf = "\n\r";

            $ignore_fields = array($options['form_id'], 'g-recaptcha-response');

            $text = $options['intro'].$lf.$lf;
            $html = "<p>{$options['intro']}</p>";

            $from_email = null;

            $this->processed = true;

            if($options['captcha']) {
                if(empty($options['captcha_key']) || empty($options['captcha_secret'])) {
                    $this->error = 'Captcha key and secret are not set.';
                    return true;
                }

                if(empty($_POST['g-recaptcha-response'])) {
                    $this->error = 'Captcha response is not present.';
                    return true;

                } else if($this->validate_rechapcha($_POST['g-recaptcha-response'], $options['captcha_secret']) !== true) {
                    $this->error = 'Captcha validation failed.';
                    return true;
                }
            }

            foreach($_POST as $key => $value) {
                if(!in_array( $key, $ignore_fields)) {
                    $key = filter_var($key, FILTER_SANITIZE_STRING);
                    $value = filter_var($value, FILTER_SANITIZE_STRING);

                    $text .= "{$key}: {$value}".$lf;

                    if($key == 'email' || $key == 'Email') {
                        $from_email = $value;
                    }

                    $html .= "<p><b>{$key}</b>: {$value}</p>";
                }
            }

            $stamp = "Submitted on ".date("F j, Y, g:i a");
            if($options['log_ip'] && !empty($_SERVER['REMOTE_ADDR'])) {
                $stamp .= " from ".$_SERVER['REMOTE_ADDR'];
            }

            $text .= $stamp;
            $html .= "<p><em>{$stamp}</em></p>";

            $this->text = $text;
            $this->html = $html;

            $emailed = null;
            $saved = null;

            if($options['send_to_email']) {
                $headers = 'From: '. $admin_email . "\r\n";
                $emailed = wp_mail($options['email'], $options['title'], $text, $headers);
            }
            if($options['save_to_post_type']) {
                if(wp_insert_post( array(
                    'post_title' => $options['title'].(!empty( $from_email ) ? (" - ".$from_email) : ""),
                    'post_content' => $html,
                    'post_type' => $options['post_type'],
                    'post_status' => 'private'
                ) )) {
                    $saved = true;
                } else {
                    $saved = false;
                }
            }

            if((!$emailed && !$saved) || $emailed === false || $saved === false) {
                $this->error = true;
                $this->message = $options['error_message'];
            } else {
                $this->error = false;
                $this->message = $options['success_message'];
            }

            return true;
        } else {
            //the form was not submitted
            $this->processed = false;
            $this->error = false;
            return false;
        }

    }

    //source https://gist.github.com/jonathanstark/dfb30bdfb522318fc819
    public function validate_rechapcha($response, $secret)
    {
        // Verifying the user's response (https://developers.google.com/recaptcha/docs/verify)
        $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

        $query_data = [
            'secret' => $secret,
            'response' => $response,
            'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
        ];

        // Collect and build POST data
        $post_data = http_build_query($query_data, '', '&');

        // Send data on the best possible way
        if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec'))
        {
            // Use cURL to get data 10x faster than using file_get_contents or other methods
            $ch = curl_init($verifyURL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
            $response = curl_exec($ch);
            curl_close($ch);
        }
        else
        {
            // If server not have active cURL module, use file_get_contents
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $post_data
                )
            );
            $context = stream_context_create($opts);
            $response = file_get_contents($verifyURL, false, $context);
        }

        // Verify all reponses and avoid PHP errors
        if ($response)
        {
            $result = json_decode($response);
            if ($result->success === true)
            {
                return true;
            }
            else
            {
                return $result;
            }
        }

        // Dead end
        return false;
    }

}

class PG_Article_Form_Mailer {

    public $processed = false;
    public $error = true;
    public $message = 'The form was not submitted';
    public $text = null;
    public $html = null;

    public function process( $arg_options = array() ) {

        $admin_email = get_option('admin_email');

        $options = array(
            'form_id' => 'article_form',
            'send_to_email' => false,
            'email' => $admin_email,
            'title' => 'Article form submission',
            'intro' => 'We received a new article form submission:',
            'save_to_post_type' => null,
            'post_type' => null,
            'captcha' => false,
            'captcha_key' => null,
            'captcha_secret' => null,
            'log_ip' => true,
            'success_message' => 'Thank you for contributing!',
            'error_message' => 'There was a problem submitting this form. Please contact us directly.'
        );

        //merge options
        foreach($arg_options as $key => $value) {
            $options[ $key ] = $value;
        }

        if( !empty($_POST[$options['form_id']]) ) {
            //the form was submitted
            //we assume the browser did the validation
            $lf = "\n\r";

            $ignore_fields = array($options['form_id'], 'g-recaptcha-response');

            $text = $options['intro'].$lf.$lf;
            $html = "<p>{$options['intro']}</p>";

            $from_email = null;

            $this->processed = true;

            if($options['captcha']) {
                if(empty($options['captcha_key']) || empty($options['captcha_secret'])) {
                    $this->error = 'Captcha key and secret are not set.';
                    return true;
                }

                if(empty($_POST['g-recaptcha-response'])) {
                    $this->error = 'Captcha response is not present.';
                    return true;

                } else if($this->validate_rechapcha($_POST['g-recaptcha-response'], $options['captcha_secret']) !== true) {
                    $this->error = 'Captcha validation failed.';
                    return true;
                }
            }

            foreach($_POST as $key => $value) {
                if(!in_array( $key, $ignore_fields)) {
                    $key = filter_var($key, FILTER_SANITIZE_STRING);
                    $value = filter_var($value, FILTER_SANITIZE_STRING);

                    $text .= "{$key}: {$value}".$lf;

                    if($key == 'email' || $key == 'Email') {
                        $from_email = $value;
                    }

                    $html .= "<p><b>{$key}</b>: {$value}</p>";
                }
            }

            $stamp = "Submitted on ".date("F j, Y, g:i a");
            if($options['log_ip'] && !empty($_SERVER['REMOTE_ADDR'])) {
                $stamp .= " from ".$_SERVER['REMOTE_ADDR'];
            }

            $text .= $stamp;
            $html .= "<p><em>{$stamp}</em></p>";

            $this->text = $text;
            $this->html = $html;

            $emailed = null;
            $saved = null;
            $postID = null;
            $content1 = null;            

            // open graph data
    
            $url = $_POST['article1'];
            $graph = OpenGraph::fetch($url);
            function dismount($object) {
                $reflectionClass = new ReflectionClass(get_class($object));
                $array = array();
                foreach ($reflectionClass->getProperties() as $property) {
                    $property->setAccessible(true);
                    $array[$property->getName()] = $property->getValue($object);
                    $property->setAccessible(false);
                }
                return $array;                
            }
            function clean($string) {
                $string = str_replace('[', '(', $string); // Replaces all braces
                $string = str_replace(']', ')', $string); // Replaces all braces
                $string = str_replace('"', '`' , $string); // Replaces all quotes 
             
                return $string; // Replaces multiple hyphens with single one.
             }

            $graph = dismount($graph);
            $og_title = clean($graph['_values']['title']);
            if (empty($og_title)) {
                $og_title = parse_url($url, PHP_URL_HOST);
            }
            $og_summary = clean($graph['_values']['description']) ;
            $og_image =  $graph['_values']['image'] ; 
            $og_media_agency = $graph['_values']['site_name'] ; 
            
             
            $content1 = '[visual-link-preview type="external" url="'.esc_url($_POST['article1']) .'" image_id="-1" image_url="'. $og_image .'" title="'. $og_title  .'" summary="'. $og_summary. '" template="Simple"]';             
        
            if($options['send_to_email']) {
                $headers = 'From: '. $admin_email . "\r\n";
                $emailed = wp_mail($options['email'], $options['title'], $text, $headers);
            }
            if($options['save_to_post_type']) {
                if($postID = wp_insert_post( array(
                    'post_title' => esc_url_raw($_POST['article1']),
                    'post_content' => $content1,
                    'post_type' => 'article',
                    'post_status' => 'publish'   // if volume of submissions gets too high, convert this to published
                ) )) {
                    $saved = true;
                    
                    update_field('media_agency', $og_media_agency , $postID); // update ACF fields
                    update_field('article_link', esc_url_raw($_POST['article1']), $postID); // update ACF fields                    
                    $articles_list = array();
                    $articles_list = get_field('linked_articles', $_POST['issue']) ;
                    $articles_list[] =  $postID;
                    update_field('linked_articles', $articles_list , $_POST['issue']); // update ACF relationship field in the issue with this post id                                   
                } else {
                    $saved = false;
                }
            }

            if((!$emailed && !$saved) || $emailed === false || $saved === false) {
                $this->error = true;
                $this->message = $options['error_message'];
            } else {
                $this->error = false;
                $this->message = $options['success_message'];
            }

            return true;
        } else {
            //the form was not submitted
            $this->processed = false;
            $this->error = false;
            return false;
        }

    }

    //source https://gist.github.com/jonathanstark/dfb30bdfb522318fc819
    public function validate_rechapcha($response, $secret)
    {
        // Verifying the user's response (https://developers.google.com/recaptcha/docs/verify)
        $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

        $query_data = [
            'secret' => $secret,
            'response' => $response,
            'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
        ];

        // Collect and build POST data
        $post_data = http_build_query($query_data, '', '&');

        // Send data on the best possible way
        if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec'))
        {
            // Use cURL to get data 10x faster than using file_get_contents or other methods
            $ch = curl_init($verifyURL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
            $response = curl_exec($ch);
            curl_close($ch);
        }
        else
        {
            // If server not have active cURL module, use file_get_contents
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $post_data
                )
            );
            $context = stream_context_create($opts);
            $response = file_get_contents($verifyURL, false, $context);
        }

        // Verify all reponses and avoid PHP errors
        if ($response)
        {
            $result = json_decode($response);
            if ($result->success === true)
            {
                return true;
            }
            else
            {
                return $result;
            }
        }

        // Dead end
        return false;
    }

}


class PG_Issue_Form_Mailer {

    public $processed = false;
    public $error = true;
    public $message = 'The form was not submitted';
    public $text = null;
    public $html = null;

    public function process( $arg_options = array() ) {

        $admin_email = get_option('admin_email');

        $options = array(
            'form_id' => 'issue_form',
            'send_to_email' => false,
            'email' => $admin_email,
            'title' => 'Issue form submission',
            'intro' => 'We received a new issue form submission:',
            'save_to_post_type' => null,
            'post_type' => null,
            'captcha' => false,
            'captcha_key' => null,
            'captcha_secret' => null,
            'log_ip' => true,
            'success_message' => 'Thank you for contributing!',
            'error_message' => 'There was a problem submitting this form. Please contact us directly.'
        );

        //merge options
        foreach($arg_options as $key => $value) {
            $options[ $key ] = $value;
        }

        if( !empty($_POST[$options['form_id']]) ) {
            //the form was submitted
            //we assume the browser did the validation
            $lf = "\n\r";

            $ignore_fields = array($options['form_id'], 'g-recaptcha-response');

            $text = $options['intro'].$lf.$lf;
            $html = "<p>{$options['intro']}</p>";

            $from_email = null;

            $this->processed = true;

            if($options['captcha']) {
                if(empty($options['captcha_key']) || empty($options['captcha_secret'])) {
                    $this->error = 'Captcha key and secret are not set.';
                    return true;
                }

                if(empty($_POST['g-recaptcha-response'])) {
                    $this->error = 'Captcha response is not present.';
                    return true;

                } else if($this->validate_rechapcha($_POST['g-recaptcha-response'], $options['captcha_secret']) !== true) {
                    $this->error = 'Captcha validation failed.';
                    return true;
                }
            }

            foreach($_POST as $key => $value) {
                if(!in_array( $key, $ignore_fields)) {
                    $key = filter_var($key, FILTER_SANITIZE_STRING);
                    $value = filter_var($value, FILTER_SANITIZE_STRING);

                    $text .= "{$key}: {$value}".$lf;

                    if($key == 'email' || $key == 'Email') {
                        $from_email = $value;
                    }

                    $html .= "<p><b>{$key}</b>: {$value}</p>";
                }
            }

            $stamp = "Submitted on ".date("F j, Y, g:i a");
            if($options['log_ip'] && !empty($_SERVER['REMOTE_ADDR'])) {
                $stamp .= " from ".$_SERVER['REMOTE_ADDR'];
            }

            $text .= $stamp;
            $html .= "<p><em>{$stamp}</em></p>";

            $this->text = $text;
            $this->html = $html;

            $emailed = null;
            $saved = null;
            $postID = null;
            $content1 = null;        

            // open graph data


            $url = $_POST['article1'];
            $graph = OpenGraph::fetch($url);
            function dismount($object) {
                $reflectionClass = new ReflectionClass(get_class($object));
                $array = array();
                foreach ($reflectionClass->getProperties() as $property) {
                    $property->setAccessible(true);
                    $array[$property->getName()] = $property->getValue($object);
                    $property->setAccessible(false);
                }
                return $array;
            }
            function clean($string) {
                $string = str_replace('[', '(', $string); // Replaces all spaces with hyphens.
                $string = str_replace(']', ')', $string); // Replaces all spaces with hyphens.
                $string = str_replace('"', '`' , $string); // Replaces all spaces with hyphens.
             
                return $string; // Replaces multiple hyphens with single one.
             }

            $graph = dismount($graph);
            $og_title = clean($graph['_values']['title']);
            $og_summary = clean($graph['_values']['description']) ;
            $og_image =  $graph['_values']['image'] ; 
            $og_media_agency = $graph['_values']['site_name'] ; 
            
            
             
            $content1 = '[visual-link-preview type="external" url="'.esc_url($_POST['article1']) .'" image_id="-1" image_url="'. $og_image .'" title="'. $og_title  .'" summary="'. $og_summary. '" template="Simple"]'; 
            $issue_title = filter_var($_POST['issue_title'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);   

            if($options['send_to_email']) {
                $headers = 'From: '. $admin_email . "\r\n";
                $emailed = wp_mail($options['email'], $options['title'], $text, $headers);
            }
            if($options['save_to_post_type']) {
                if($postID = wp_insert_post( array(
                    'post_title' => $issue_title,
                    'post_content' => $html,
                    'post_type' => 'issue',
                    'post_status' => 'publish'
                ) )) {
                    $saved = true;
                    // update_field('date', $options['issue_date'], $postID); // update ACF fields
                    // now add the link that was submitted with the issue
                    if($postID2 = wp_insert_post( array(
                        'post_title' => esc_url_raw($_POST['article1']),
                        'post_content' => $content1,
                        'post_type' => 'article',
                        'post_status' => 'publish'   // if volume of submissions gets too high, convert this to published
                    ) )) {
                        $saved = true;
                        $og_media_agency;
                        update_field('media_agency', $og_media_agency, $postID2); // update ACF fields
                        update_field('article_link', esc_url_raw($_POST['article1']), $postID2); // update ACF fields                    
                        $articles_list = array();
                        // $articles_list = get_field('linked_articles', $postID) ;  // current array should be null for a new issue
                        $articles_list[] =  $postID2;
                        update_field('linked_articles', $articles_list , $postID); // update ACF relationship field in the issue with this post id                                   
                    } else {
                        $saved = false;
                    }
                   
                } else {
                    $saved = false;
                }
            }

            if((!$emailed && !$saved) || $emailed === false || $saved === false) {
                $this->error = true;
                $this->message = $options['error_message'];
            } else {
                $this->error = false;
                $this->message = $options['success_message'];
            }

            return true;
        } else {
            //the form was not submitted
            $this->processed = false;
            $this->error = false;
            return false;
        }

    }

    //source https://gist.github.com/jonathanstark/dfb30bdfb522318fc819
    public function validate_rechapcha($response, $secret)
    {
        // Verifying the user's response (https://developers.google.com/recaptcha/docs/verify)
        $verifyURL = 'https://www.google.com/recaptcha/api/siteverify';

        $query_data = [
            'secret' => $secret,
            'response' => $response,
            'remoteip' => (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'])
        ];

        // Collect and build POST data
        $post_data = http_build_query($query_data, '', '&');

        // Send data on the best possible way
        if (function_exists('curl_init') && function_exists('curl_setopt') && function_exists('curl_exec'))
        {
            // Use cURL to get data 10x faster than using file_get_contents or other methods
            $ch = curl_init($verifyURL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-type: application/x-www-form-urlencoded'));
            $response = curl_exec($ch);
            curl_close($ch);
        }
        else
        {
            // If server not have active cURL module, use file_get_contents
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $post_data
                )
            );
            $context = stream_context_create($opts);
            $response = file_get_contents($verifyURL, false, $context);
        }

        // Verify all reponses and avoid PHP errors
        if ($response)
        {
            $result = json_decode($response);
            if ($result->success === true)
            {
                return true;
            }
            else
            {
                return $result;
            }
        }

        // Dead end
        return false;
    }

}