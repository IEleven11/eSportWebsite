<script>

    function joinFormsIn(form) {
        <?php
            $fade = "";
        
            foreach ($sections as $section) {
                
                if ($fade == "" || $fade == "Up") {
                    
                    $fade = "Down";
                    
                    $fade2 = "Up";
                    
                } elseif ($fade == "Down") {
                    
                    $fade = "Up";
                    
                    $fade2 = "Down";
                    
                }

    ?>
    
    $("#<?php echo $section['sectioncut']; ?>Card").removeClass("fadeIn<?php echo $fade;?>").addClass("animated fadeOut<?php echo $fade2;?>");
    
    <?php } ?>
    
    setTimeout(function(){
        <?php foreach ($sections as $section) { ?>
        
            $("#<?php echo $section['sectioncut']; ?>Card").hide();
        
        <?php } ?>
        
        document.getElementsByClassName(form)[0].classList.remove("animated", "fadeOutRightBig");
        document.getElementsByClassName(form)[0].classList.add("animated", "fadeInRightBig");
        document.getElementsByClassName(form)[0].style.display = "block";
    },1000)
    
}

function joinFormsOut(form) {
    
    $(".is-invalid").removeClass("is-invalid");
    
    document.getElementsByClassName(form)[0].classList.remove("fadeInRightBig");
    document.getElementsByClassName(form)[0].classList.add("animated", "fadeOutRightBig");

    setTimeout(function(){
        
        <?php
            $fade = "";
        
            foreach ($sections as $section) {
                
                if ($fade == "" || $fade == "Down") {
                    
                    $fade = "Up";
                    
                    $fade2 = "Down";
                    
                } elseif ($fade == "Up") {
                    
                    $fade = "Down";
                    
                    $fade2 = "Up";
                    
                }

    ?>
    
    $("#<?php echo $section['sectioncut']; ?>Card").removeClass("fadeOut<?php echo $fade;?>").addClass("animated fadeIn<?php echo $fade2;?>");
    
    <?php } ?>
        
        document.getElementsByClassName(form)[0].style.display = "none";
        
        <?php foreach ($sections as $section) { ?>
        
            $("#<?php echo $section['sectioncut']; ?>Card").show();
        
        <?php } ?>
        
    },800)


}

function joinShowsIn(form) {
    
    if ($("." + form + "Card")[0]){
        
        <?php
            $fade = "";
        
            foreach ($sections as $section) {
                
                if ($fade == "" || $fade == "Down") {
                    
                    $fade = "Up";
                    
                    $fade2 = "Down";
                    
                } elseif ($fade == "Up") {
                    
                    $fade = "Down";
                    
                    $fade2 = "Up";
                    
                }

    ?>
    
    $("#<?php echo $section['sectioncut']; ?>Card").removeClass("fadeIn<?php echo $fade;?>").addClass("animated fadeOut<?php echo $fade2;?>");
    
    <?php } ?>

        setTimeout(function(){
        <?php foreach ($sections as $section) { ?>
        
            $("#<?php echo $section['sectioncut']; ?>Card").hide();
        
        <?php } ?>

            var cards = document.getElementsByClassName(form + "Card"),
                btns = document.getElementsByClassName(form + "Btn");
            
            for (var i = 0; i < cards.length; i++) {
            
                cards[i].classList.remove("animated", "fadeOutRightBig");
                cards[i].classList.add("animated", "fadeInRightBig");
                cards[i].style.display = "block";
                
            }
            
            for (i = 0; i < btns.length; i++) {
            
                btns[i].classList.remove("animated", "fadeOutRightBig");
                btns[i].classList.add("animated", "fadeInRightBig");
                btns[i].style.display = "block";
                
            }
        
        },1000);
        
    } else {
        alert("لا يوجد أعضاء في هذا الفريق");
    }
}
    

function joinShowsOut(form) {
    
    
    var cards = document.getElementsByClassName(form + "Card"),
        btns = document.getElementsByClassName(form + "Btn");

    for (var i = 0; i < cards.length; i++) {

        cards[i].classList.remove("fadeInRightBig");
        cards[i].classList.add("animated", "fadeOutRightBig");

    }

    for (i = 0; i < btns.length; i++) {

        btns[i].classList.remove("fadeInRightBig");
        btns[i].classList.add("animated", "fadeOutRightBig");

    }

    setTimeout(function(){
        
        for (var i = 0; i < cards.length; i++) {
            
            cards[i].style.display = "none";
            
        }
        
        for (var i = 0; i < btns.length; i++) {
            
            btns[i].style.display = "none";
            
        }
        
                <?php
            $fade = "";
        
            foreach ($sections as $section) {
                
                if ($fade == "" || $fade == "Up") {
                    
                    $fade = "Down";
                    
                    $fade2 = "Up";
                    
                } elseif ($fade == "Down") {
                    
                    $fade = "Up";
                    
                    $fade2 = "Down";
                    
                }

    ?>
    
    $("#<?php echo $section['sectioncut']; ?>Card").removeClass("fadeOut<?php echo $fade;?>").addClass("animated fadeIn<?php echo $fade2;?>");
    
    <?php } ?>
        
        <?php foreach ($sections as $section) { ?>
        
            $("#<?php echo $section['sectioncut']; ?>Card").show();
        
        <?php } ?>
        
    },800)

    
}

function validateJoinForms(form) {
    
    var firstname = $("." + form).find(".joinFormFirstName"),
        lastname = $("." + form).find(".joinFormLastName"),
        username = $("." + form).find(".joinFormUsername"),
        email = $("." + form).find(".joinFormEmail"),
        phone = $("." + form).find(".joinFormPhone"),
        twitter = $("." + form).find(".joinFormTwitter"),
        insta = $("." + form).find(".joinFormInsta"),
        sex = $("." + form).find(".joinFormSex"),
        platform = $("." + form).find(".joinFormPlatform"),
        country = $("." + form).find(".joinFormCountry"),
    
        firstnameLog = $("." + form).find(".joinFormFirstNameLog"),
        lastnameLog = $("." + form).find(".joinFormLastNameLog"),
        usernameLog = $("." + form).find(".joinFormUsernameLog"),
        emailLog = $("." + form).find(".joinFormEmailLog"),
        phoneLog = $("." + form).find(".joinFormPhoneLog"),
        twitterLog = $("." + form).find(".joinFormTwitterLog"),
        instaLog = $("." + form).find(".joinFormInstaLog");
    
    
    firstname.removeClass("is-invalid");
    lastname.removeClass("is-invalid");
    username.removeClass("is-invalid");
    email.removeClass("is-invalid");
    phone.removeClass("is-invalid");
    twitter.removeClass("is-invalid");
    insta.removeClass("is-invalid");
    sex.removeClass("is-invalid");
    platform.removeClass("is-invalid");
    country.removeClass("is-invalid");
    
    if (firstname.val() == "") {

        firstname.addClass("is-invalid");

        firstnameLog.text("لا تترك الخانة فاضية");

        return false;

    } if (!isNaN(firstname.val())) {
        
        firstname.addClass("is-invalid");
        
        firstnameLog.text("يمكنك فقط كتابة الأحرف");
        
        return false;
        
    } if (firstname.val().length > 12 || firstname.val().length < 3) {

        firstname.addClass("is-invalid");

        firstnameLog.text("يجب ان يكون الإسم ما بين 3 - 12");

        return false;

    } if (lastname.val() == "") {

        lastname.addClass("is-invalid");

        lastnameLog.text("لا تترك الخانة فاضية");

        return false;

    } if (!isNaN(lastname.val())) {
        
        lastname.addClass("is-invalid");
        
        lastnameLog.text("يمكنك فقط كتابة الأحرف");
        
        return false;
        
    } if (lastname.val().length > 12 || lastname.val().length < 3) {

        lastname.addClass("is-invalid");

        lastnameLog.text("يجب ان يكون الإسم ما بين 3 - 12");

        return false;

    } if (username.val() == "") {

        username.addClass("is-invalid");

        usernameLog.text("لا تترك الخانة فاضية");

        return false;

    } if (!isNaN(username.val())) {
        
        username.addClass("is-invalid");
        
        usernameLog.text("يمكنك فقط كتابة الأحرف");
        
        return false;
        
    } if (username.val().length > 16 || username.val().length < 3) {

        username.addClass("is-invalid");

        usernameLog.text("يجب ان يكون الحساب ما بين 3 - 16");

        return false;

    } if (email.val() == "") {

        email.addClass("is-invalid");

        emailLog.text("لا تترك الخانة فاضية");

        return false;

    } if (email.val().length > 40 || email.val().length < 6) {

        email.addClass("is-invalid");

        emailLog.text("يجب أن يكون البريد الإلكتروني ما بين 6 - 40");

        return false;

    } if (phone.val() == "") {

        phone.addClass("is-invalid");

        phoneLog.text("لا تترك الخانة فاضية");
        
        return false;

    } if (isNaN(phone.val())) {

        phone.addClass("is-invalid");

        phoneLog.text("يمكنك فقط كتابة الأرقام");

        return false;
        
    } if (phone.val().length > 15 || phone.val().length < 6) {

        phone.addClass("is-invalid");

        phoneLog.text("يجب أن يكون رقم الهاتف ما بين 6 - 15");
        
        return false;

    } if (twitter.val() == "" && insta.val() == "") {

        twitter.addClass("is-invalid");

        twitterLog.text("إختر وحدة أو أكثر من وحدة");
        
        insta.addClass("is-invalid");

        instaLog.text("إختر وحدة أو أكثر من وحدة");

        return false;

    } if (twitter.val() != "") {
        
        if (twitter.val().charAt(0) != "@") {

            twitter.addClass("is-invalid");

            twitterLog.text("يجب أن يبدأ الحساب ب '@'");

            return false;

        } if (twitter.val().length > 18 || twitter.val().length < 3) {

            twitter.addClass("is-invalid");

            twitterLog.text("يجب أن يكون حساب تويتر ما بين 3 - 18");

            return false;

        }

        } if(insta.val() != "") { 
            
            if (insta.val().charAt(0) != "@") {

            insta.addClass("is-invalid");

            instaLog.text("يجب أن يبدأ الحساب ب '@'");

            return false;

        } if (insta.val().length > 18 || insta.val().length < 3) {

            insta.addClass("is-invalid");

            instaLog.text("يجب أن يكون حساب انستقرام ما بين 3 - 18");

            return false;

        }
                                 
    } if (sex.val() == "") {

        sex.addClass("is-invalid");

        return false;

    } if (platform.val() == "") {

        platform.addClass("is-invalid");

        return false;

    } if (country.val() == "") {

        country.addClass("is-invalid");

        return false;

    }
    
    switch(form) {
            
        <?php foreach ($sections as $section) {
            ?>

        case "<?php echo $section['sectioncut']; ?>Form":
            
            $(".is-invalid").removeClass("is-invalid");
            console.log("." + form + ".is-invalid");

          <?php
                    $sectionForms = [
                        $section['form1'],
                        $section['form2'],
                        $section['form3'],
                        $section['form4'],
                        $section['form5'],
                        $section['form6'],
                        $section['form7'],
                        $section['form8']
                    ];

            foreach ($sectionForms as $form) {


                if ($form == "") {
                    break;           // don't count the empty forms ..
                }

                $terms = getDatav2("*", "sectionterms", "sectionid", $section['sectionid'] . " AND formname = '$form'");

                foreach ($terms as $term) {

                     if ($term['empty'] == 0) { ?>

                        if ($("#<?php echo $section['sectioncut'] . $form; ?>").val() == "") {

                            $("#<?php echo $section['sectioncut'] . $form; ?>").addClass("is-invalid");

                            $("#<?php echo $section['sectioncut'] . $form; ?>Log").text("لا تترك الخانة فاضية");

                            return false;

                        }

          <?php     } if ($term['number'] == 1) { ?>

                        if (isNaN($("#<?php echo $section['sectioncut'] . $form; ?>").val())) {

                            $("#<?php echo $section['sectioncut'] . $form; ?>").addClass("is-invalid");

                            $("#<?php echo $section['sectioncut'] . $form; ?>Log").text("يمكنك فقط كتابة الأرقام");

                            return false;

                        }

           <?php    } if ($term['number'] == 0) { ?>

                        if (!isNaN($("#<?php echo $section['sectioncut'] . $form; ?>").val())) {

                            $("#<?php echo $section['sectioncut'] . $form; ?>").addClass("is-invalid");

                            $("#<?php echo $section['sectioncut'] . $form; ?>Log").text("يمكنك فقط كتابة الأحرف");

                            return false;

                        }

           <?php    } if ($term['number'] == 1) { ?>
                                    
                        if ($("#<?php echo $section['sectioncut'] . $form; ?>").val() > <?php echo $term['max']; ?> || $("#<?php echo $section['sectioncut'] . $form; ?>").val() < <?php echo $term['min']; ?>) {

                            $("#<?php echo $section['sectioncut'] . $form; ?>").addClass("is-invalid");

                            $("#<?php echo $section['sectioncut'] . $form; ?>Log").text("يجب ان يكون <?php echo $form; ?> ما بين <?php echo $term['min']; ?> - <?php echo $term['max']; ?>");

                            return false;

                        }
            

              <?php } if ($term['number'] == 0) { ?>

                        if ($("#<?php echo $section['sectioncut'] . $form; ?>").val().length > <?php echo $term['max']; ?> || $("#<?php echo $section['sectioncut'] . $form; ?>").val().length < <?php echo $term['min']; ?>) {

                            $("#<?php echo $section['sectioncut'] . $form; ?>").addClass("is-invalid");

                            $("#<?php echo $section['sectioncut'] . $form; ?>Log").text("يجب ان يكون <?php echo $form ?> ما بين <?php echo $term['min']; ?> - <?php echo $term['max']; ?>");

                            return false;

                        }
    
          <?php     }  if ($term['selection'] == 1) { ?>

                        if ($("#<?php echo $section['sectioncut'] . $form; ?>").val() == "") {

                            $("#<?php echo $section['sectioncut'] . $form; ?>").addClass("is-invalid");

                            return false;

                        }

              <?php }
    
                }
                
            }
                ?>
    
                    break;
    
    <?php } ?>
    
    }
    
}
</script>