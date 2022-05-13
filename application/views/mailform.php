<!DOCTYPE html>
<html>
    <head>
        <title>CodeIgniter Send Email</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->load->view('admin_header');?>
    </head>
    <body>
           <div class="container-xxl flex-grow-1 container-p-y">
            <h3>Use the form below to send email</h3>
            <form method="post" action="<?=base_url('sendMail')?>" enctype="multipart/form-data">
                <input type="email" id="to" name="to" placeholder="Receiver Email">
                <br><br>
                <input type="text" id="subject" name="subject" placeholder="Subject">
                <br><br>
                <textarea rows="6" id="message" name="message" placeholder="Type your message here"></textarea>
                <br><br>
                <input type="submit" value="Send Email" />
            </form>
        </div>
    </body>
    <?php $this->load->view('admin_footer');?>
</html>