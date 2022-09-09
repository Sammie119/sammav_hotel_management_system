<?php
    
    include_once (__DIR__.'/../../lib/Zenoph/Notify/AutoLoader.php');
    
    use Zenoph\Notify\Enums\AuthModel;
    use Zenoph\Notify\Request\NotifyRequest;
    use Zenoph\Notify\Request\CreditBalanceRequest;
    
    try {
        /**
         * Replace [messaging_website_domain] with the website domain on which account exists
         * 
         * Eg, if website domain is thewebsite.com, then set host as api.thewebsite.com
         * 
         * For further information, read the documentation for what you should set as the host
         */
        NotifyRequest::setHost('api.smsonlinegh.com');
        
        
        /* By default, HTTPS connection is used to send requests. If you want to disable the use of HTTPS
         * and rather use HTTP connection, comment out the call to useSecureConnection below below this comment
         * block and pass false as argument to the function call.
         * 
         * When testing on local machine on which https connection does not work, you may encounter 
         * request submit error with status value zero (0). If you want to use HTTPS connection on local machine, 
         * then you can instruct that the Certificate Authority file (cacert.pem) which accompanies the SDK be 
         * used to be able to use HTTPS from your local machine by setting the second argument of the function call to 'true'.
         * That is:
         *         NotifyRequest::useSecureConnection(true, true);
         * 
         * You can download the current Certificates Authority file (cacert.pem) file from https://curl.se/docs/caextract.html
         * to replace the one in the main root directory of the SDK. Please maintain the file name as cacert.pem
         */
        NotifyRequest::useSecureConnection(true);    
        
        $cr = new CreditBalanceRequest();
        $cr->setAuthModel(AuthModel::API_KEY);
        $cr->setAuthApiKey('f0fcd8c8b7aadf217e6a95793070eb68543029a2aec2ac5524ad4f519cbdf2d0');
        
        /*
         * Submit the request for a response.
         * An object of CreditBalanceResponse will be returned
         */
        $br = $cr->submit();
        
        # get the balance
        $balance = $br->getBalance();
        
        echo "Balance is: {$balance}.";
    } 
    
    catch (\Exception $ex) {
        die ($ex->getMessage());
    }

