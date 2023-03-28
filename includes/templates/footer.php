<div class="footerBackGround">
    <div class="footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <div class="contact-us">
                        <div class="icon"><a target="_blank" href="https://twitter.com/suhailbahawi"><i class="fab fa-twitter-square fa-2x Social-icons"></i></a></div>
                        <div class="icon"><a target="_blank" href="#"><i class="fab fa-youtube fa-2x Social-icons"></i></a></div>
                        <div class="icon"><a target="_blank" href="#"><i class="fab fa-instagram fa-2x Social-icons"></i></a></div>
                        <div class="icon"><a target="_blank" href="#"><i class="fab fa-telegram fa-2x Social-icons"></i></a></div>
                        <div class="icon"><a target="_blank" href="#"><i class="fab fa-discord fa-2x Social-icons"></i></a></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="footer-about">
                        <img class="footer-about-img" src="<?php echo $websiteLogo; ?>">
                        <p class="lead lang" key="footer-about-text">فريق سعودي للرياضية الإلكترونية يهدف للوصول الى العالمية</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="footer-list">
                        <p class="lead">
                               <a href="#" class="lang" key="footer-main">الرئيسية</a>
                            <strong>&nbsp;|&nbsp;</strong>  <a href="#aboutUs" class="lang" key="footer-about">من نحن</a>
                            <strong>&nbsp;|&nbsp;</strong>  <a href="#news" class="lang" key="footer-news">آخر الأخبار</a>
                            <strong>&nbsp;|&nbsp;</strong>  <a href="#membersCount" class="lang" key="footer-members">أعضاء الفريق</a>
                            <strong>&nbsp;|&nbsp;</strong>  <a href="#membersShowAndJoin" class="lang" key="footer-join">الفرق وطلب الإنضمام</a>
                            <strong>&nbsp;|&nbsp;</strong>  <a href="#callUs" class="lang" key="footer-contact"> تواصل معنا</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer-cr">
    <div class="container text-center">
        <p class="lead">
            Copyright &copy; <i>2019-2020</i>.&nbsp;<strong><?php echo $websiteName; ?> eSport</strong>
        </p>
    </div>
</div>
 
    <script src="includes/layout/js/jquery.min.js"></script>
    <script src="includes/layout/js/jquery.nicescroll.min.js"></script>
    <script src="includes/layout/js/smooth-scroll.min.js"></script>
    <script src="includes/layout/js/popper.min.js"></script>
    <script src="includes/layout/js/bootstrap.min.js"></script>
    <script src="includes/layout/js/wow.min.js"></script>
    <script src="includes/layout/js/owl.carousel.min.js"></script>
    <script src="includes/layout/js/instafeed.min.js"></script>
    <?php include "includes/layout/js/formsValidate.php"; // php + js file ?>
    <script src="includes/layout/js/main.js"></script>
    <script type="text/javascript">

        var arrLang = {
            
            'ar': {
                
                'index-title': 'للرياضة الإلكترونية <?php echo $websiteName; ?> الموقع الرسمي لفريق',
                'index-btn-signup': 'الإنضمام',
                'index-btn-login': 'تسجيل الدخول',
                'index-btn-gotoPanel': 'الانتقال للوحة التحكم',
                'index-signin': 'تسجيل الدخول',
                'index-label-email': 'البريد الإلكتروني',
                'index-label-password': 'الرمز السري',
                'index-passwordforgot': 'هل نسيت كلمة المرور ؟',
                'index-new-password': 'كلمة مرور جديدة',
                'index-new-password-send': 'إرسال كلمة المرور للبريد الإلكتروني',
                'index-whoarewe': 'من نحن ؟',
                'index-main-about': 'فريق الإلكتروني  تم اعتماده من قبل اتحاد الرياضات الإلكترونية والذهنية في عام ٢٠١٩ بشكل رسمي طموحه تمثيل المملكة العربية السعودية في البطولات العالمية وتحقيق البطولات والمراتب متقدمة في البطولات الداخلية',
                'index-members': 'أعضاء الفريق',
                'index-team-count': 'الفرق',
                'index-members-count': 'الأعضاء',
                'index-team-join': 'الفرق وطلب الإنضمام',
                'index-team-members-count': 'عدد اللاعبين: <?php echo membersCount("specialty", $sectionCName); ?>',
                'index-form-choose': 'إختر شيئًا',
                'index-form-send': 'أرسل',
                'index-form-back': 'الرجوع للخلف',
                'index-last-news': 'آخر الأخبار',
                'index-ticket-email': '<?php echo $websiteContactEmail; ?> :البريد الإلكتروني',
                'index-ticket-desc': 'وصف التذكرة',
                'index-ticket-subject': 'عنوان التذكرة',
                'index-ticket-complaint': 'شكوى',
                'index-ticket-suggestion': 'إقتراح',
                'index-ticket-help': 'مساعدة (تتطلب تسجيل دخول)',
                'index-ticket-type': 'نوع التذكرة',
                'index-ticket-fullname': 'الإسم كاملًا',
                'index-contact': 'تواصل معنا',
                
                'navbar-main': 'الرئيسية',
                'navbar-about': 'من نحن',
                'navbar-news': 'آخر الأخبار',
                'navbar-members': 'أعضاء الفريق',
                'navbar-join': 'الفرق وطلب الانضمام',
                'navbar-contact': 'تواصل معنا',
                
                'footer-about-text': 'فريق سعودي للرياضية الإلكترونية يهدف للوصول الى العالمية',
                'footer-main': 'الرئيسية',
                'footer-about': 'من نحن',
                'footer-news': 'آخر الأخبار',
                'footer-members': 'أعضاء الفريق',
                'footer-join': 'الفرق وطلب الانضمام',
                'footer-contact': 'تواصل معنا'
                
            },
            
            'en': {
                
                'index-title': 'The official website of the team <?php echo $websiteName; ?> For eSport',
                'index-btn-signup': 'Join us',
                'index-btn-login': 'Sign in',
                'index-btn-gotoPanel': 'Go to Control panel',
                'index-signin': 'Sign in',
                'index-label-email': 'Email',
                'index-label-password': 'Password',
                'index-passwordforgot': 'did you forget your password ?',
                'index-new-password': 'New Password',
                'index-new-password-send': 'Send password to Email',
                'index-whoarewe': 'Who are we ?',
                'index-main-about': 'The e-team was approved by the Federation of Electronic and Mental Sports in 2019 formally, its ambition to represent the Kingdom of Saudi Arabia in the world championships and to achieve the advanced championships and ranks in the internal championships',
                'index-members': 'Team members',
                'index-team-count': 'Teams',
                'index-members-count': 'Members',
                'index-team-join': 'Teams and Join Request',
                'index-team-members-count': 'Members Count : <?php echo membersCount("specialty", $sectionCName); ?>',
                'index-form-choose': 'Choose Something !',
                'index-form-send': 'Send',
                'index-form-back': 'Back',
                'index-last-news': 'Latest news',
                'index-ticket-email': '<?php echo $websiteContactEmail; ?> :Email',
                'index-ticket-desc': 'Ticket describe',
                'index-ticket-subject': 'Ticket subject',
                'index-ticket-complaint': 'Complaint',
                'index-ticket-suggestion': 'Suggestion',
                'index-ticket-help': 'Help (Requires login)',
                'index-ticket-type': 'Ticket type',
                'index-ticket-fullname': 'Full name',
                'index-contact': 'Contact us',
                
                'navbar-main': 'Main',
                'navbar-about': 'About us',
                'navbar-news': 'Lastest news',
                'navbar-members': 'Members',
                'navbar-join': 'Teams and Join',
                'navbar-contact': 'Contact us',
                
                'footer-about-text': 'eSport Team aims to reach the top',
                'footer-main': 'Main',
                'footer-about': 'About us',
                'footer-news': 'Lastest news',
                'footer-members': 'Members',
                'footer-join': 'Teams and Join',
                'footer-contact': 'Contact us'
                
            }
            
        };
        
        $(function(){
            
            $('.translate').click(function(){
                                  
                var lang = $(this).attr('id');
            
                $('.lang').each(function(index, element){
                    
                    $(this).text(arrLang[lang][$(this).attr('key')]);
                    
                })
                                  
            });
            
        })
        
    </script>
</body>
</html>
<?php ob_end_flush(); ?>