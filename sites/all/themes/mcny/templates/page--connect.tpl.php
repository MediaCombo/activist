<?php
// Always include main menu in pre-process of each path automatically
include_once('includes/mainmenu.php');
// Include the breadcrumb
include_once('includes/breadcrumb-page.php');
?>
<div class="row">
    <div class="container page-content">
        <div class="page-content-connect">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 no-padding leftSide-connect">
                <div class="quiz-wrapper">
                    <div class="quiz-container">
                        <div class="connect-advertise-image">
                            <!--<img src="<?php /*echo drupal_get_path('theme', 'mcny'); */?>/public/images/connect-quiz.jpg" class="img-responsive" />-->
                            <img src="<?php echo file_create_url($node->field_banner_image_quiz['und'][0]['uri']);
                            ?>"
                                 class="img-responsive" title="<?php echo $node->field_banner_image_quiz['und'][0]['title']; ?>" alt="<?php echo $node->field_banner_image_quiz['und'][0]['alt']; ?>"/>
                                <div class="advertised-text-overlap">
                                  <?php echo render($page['connect_quiz_info']); ?>
                                </div>
                        </div>
                        <?php
                            if(!empty($page['connect_quiz_response'])){
                        ?>
                        <div id="connect-response-image" class="connect-response-image margin-top-20 hidden">
                            <div id="connectQuizScore" class="heading-score">
                                You Scored: <span id="connect-quiz-score-passed">0</span> out of <span id="connect-quiz-score-failed">0</span>!
                            </div>
                            <?php echo render($page['connect_quiz_response']); ?>

                            <div class="score-share">
                                <div class="caption left">Share</div>
                                <div class="left">
                                    <!--                                    <div class="addthis_native_toolbox"></div>-->
                                    <a href="javascript:;">
                                        <span class="score-share-icon fa fa-twitter fa-2x"></span>
                                    </a>
                                    <a href="javascript:;">
                                        <span class="score-share-icon fa fa-facebook fa-2x"></span>
                                    </a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <?php
                            } else {
                        ?>
                            <div id="connect-response-image" class="connect-response-image margin-top-20 hidden"
                                 style="background: none;min-height: 0;padding-bottom: 5px;padding-top: 5px;">
                                <div id="connectQuizScore" class="heading-score" style="margin-bottom:10px;
                                font-weight: bold">
                                    You Scored: <span id="connect-quiz-score-passed">0</span> out of <span id="connect-quiz-score-failed">0</span>!
                                </div>
                            </div>
                        <?php
                            }
                        ?>

                        <div id="quizErrorMessage" class="alert alert-danger margin-top-10 hidden">
                            Please select at least one option of each question.
                        </div>

                        <div class="questions-wrapper">
                            <?php $arrQuiz = mcny_get_connect_page_quiz(); ?>
                            <div id="question-1" class="questions-container">
                                <div class="question">
                                    <div class="number left">1</div>
                                    <div class="left question-text">
                                        <?php echo $arrQuiz->field_question_one['und'][0]['value']; ?>
                                    </div>
                                </div>
                                <div class="question-options">
                                    <?php foreach($arrQuiz->field_question_one_options['und'] as $key => $questionOneOptions): ?>
                                    <div class="option">
                                        <div class="icon left">&nbsp;</div>
                                        <div class="desc left">
                                            <input type="radio" name="checkbox-question1" value="<?php echo $key+1; ?>">
                                            <div class="opt-desc"><?php echo $questionOneOptions['value']; ?></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="alert alert-success hidden">
                                    <?php echo $arrQuiz->field_question_one_message_pass['und'][0]['value']; ?>
                                </div>
                                <div class="alert alert-danger hidden">
                                    <?php echo $arrQuiz->field_question_one_message_fail['und'][0]['value']; ?>
                                </div>
                                <div id="question-1-answer-container" class="hidden"><strong>Correct Option:</strong>
                                    <div id="question-1-answer"><?php echo $arrQuiz->field_question_one_answer['und'][0]['value']; ?></div>
                                </div>
                            </div>
                            <div id="question-2" class="questions-container">
                                <div class="question">
                                    <div class="number left">2</div>
                                    <div class="left question-text"><?php echo $arrQuiz->field_question_two['und'][0]['value']; ?></div>
                                </div>
                                <div class="question-options">
                                    <?php foreach($arrQuiz->field_question_two_options['und'] as $key => $questionOneOptions): ?>
                                    <div class="option">
                                        <div class="icon left">&nbsp;</div>
                                        <div class="desc left"><input type="radio" name="checkbox-question2" value="<?php echo $key+1; ?>"/>
                                            <div class="opt-desc"><?php echo $questionOneOptions['value']; ?></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="alert alert-success hidden">
                                    <?php echo $arrQuiz->field_question_two_message_pass['und'][0]['value']; ?>
                                </div>
                                <div class="alert alert-danger hidden">
                                    <?php echo $arrQuiz->field_question_two_message_fail['und'][0]['value']; ?>
                                </div>
                                <div id="question-2-answer-container" class="hidden"><strong>Correct Option:</strong>
                                    <div id="question-2-answer"><?php echo $arrQuiz->field_question_two_answer['und'][0]['value']; ?></div>
                                </div>
                            </div>
                            <div id="question-3" class="questions-container">
                                <div class="question">
                                    <div class="number left">3</div>
                                    <div class="left question-text"><?php echo $arrQuiz->field_question_three['und'][0]['value']; ?></div>
                                </div>
                                <div class="question-options">
                                    <?php foreach($arrQuiz->field_question_three_options['und'] as $key => $questionOneOptions): ?>
                                    <div class="option">
                                        <div class="icon left">&nbsp;</div>
                                        <div class="desc left"><input type="radio" name="checkbox-question3" value="<?php echo $key+1; ?>"/>
                                            <div class="opt-desc"><?php echo $questionOneOptions['value']; ?></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="alert alert-success hidden">
                                        <?php echo $arrQuiz->field_question_three_message_pas['und'][0]['value']; ?>
                                    </div>
                                    <div class="alert alert-danger hidden">
                                        <?php echo $arrQuiz->field_question_three_message_fai['und'][0]['value']; ?>
                                    </div>
                                    <div id="question-3-answer-container" class="hidden"><strong>Correct Option:</strong>
                                        <div id="question-3-answer"><?php echo $arrQuiz->field_question_three_answer['und'][0]['value']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div id="question-4" class="questions-container">
                                <div class="question">
                                    <div class="number left">4</div>
                                    <div class="left question-text"><?php echo $arrQuiz->field_question_four['und'][0]['value']; ?></div>
                                </div>
                                <div class="question-options">
                                    <?php foreach($arrQuiz->field_question_four_options['und'] as $key => $questionOneOptions): ?>
                                    <div class="option">
                                        <div class="icon left">&nbsp;</div>
                                        <div class="desc left"><input type="radio" name="checkbox-question4" value="<?php echo $key+1; ?>"/>
                                            <div class="opt-desc"><?php echo $questionOneOptions['value']; ?></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="alert alert-success hidden">
                                        <?php echo $arrQuiz->field_question_four_message_pass['und'][0]['value']; ?>
                                    </div>
                                    <div class="alert alert-danger hidden">
                                        <?php echo $arrQuiz->field_question_four_message_fail['und'][0]['value']; ?>
                                    </div>
                                    <div id="question-4-answer-container" class="hidden"><strong>Correct Option:</strong>
                                        <div id="question-4-answer"><?php echo $arrQuiz->field_question_four_answer['und'][0]['value']; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div id="question-5" class="questions-container">
                                <div class="question">
                                    <div class="number left">5</div>
                                    <div class="left question-text"><?php echo $arrQuiz->field_question_five['und'][0]['value']; ?></div>
                                </div>
                                <div class="question-options">
                                    <?php foreach($arrQuiz->field_question_five_options['und'] as $key => $questionOneOptions): ?>
                                    <div class="option">
                                        <div class="icon left">&nbsp;</div>
                                        <div class="desc left"><input type="radio" name="checkbox-question5" value="<?php echo $key+1; ?>"/>
                                            <div class="opt-desc"><?php echo $questionOneOptions['value']; ?></div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="alert alert-success hidden">
                                        <?php echo $arrQuiz->field_question_five_message_pass['und'][0]['value']; ?>
                                    </div>
                                    <div class="alert alert-danger hidden">
                                        <?php echo $arrQuiz->field_question_five_message_fail['und'][0]['value']; ?>
                                    </div>
                                    <div id="question-5-answer-container" class="hidden"><strong>Correct Option:</strong>
                                        <div id="question-5-answer"><?php echo $arrQuiz->field_question_five_answer['und'][0]['value']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="quiz-button-container">
                            <button id="submit" name="submit" class="btn btn-default btn-submit-transparent" onclick="submitQuiz();">
                                Submit
                            </button>
                            <?php echo render($page['learn_more_btn']); ?>
                            <!--<a href="#" class="btn btn-default btn-submit-transparent hidden" id="connect_more">
                                Learn more about Gender Equality
                            </a>-->
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padding rightSide-connect">
                <div class="blog-sidebar-container">
                    <div class="header">
                        <div class="caption pull-left">
                            Submit Your Photo
                        </div>
                        <!--<div class="pull-right">
                            <a href="http://blog.activistnewyork.mcny.org/" title="Our Blog" class="btn btn-default btn-our-blog-white" target="_blank">
                                Our Blog
                            </a>
                        </div>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="description">
                        <?php echo render($page['connect_blog_text']); ?>
                    </div>
                    <div class="blog-feeds">
                        <div id="postano-embed-control-99268-14220" class="pwe_embed_controls"></div>
                        <div id="postano-embed-99268-14220" class="pwe_embed"></div>
                        <script async id="postano-embed-loader-99268-14220"
                                type="text/javascript"
                                src="//embed3.postano.com/prod/build/js/99268/14220/embed.js">
                        </script>
                    </div>
                </div>

                <div class="connect_twitter">
                    <div class="twitter-timeline-head">
                        <h2 class="visible-lg">Follow us on twitter</h2>
                        <h2 class="visible-md visible-sm visible-xs">Follow Us</h2>
                        <a href="https://twitter.com/hashtag/ActivistNY" class="btn btn-default hash-btn"><i class="fa  fa-twitter fa-2x"></i><span class="btn-txt">#ActivistNY</span></a>
                    </div>
                    <?php if($page['homepage_twitter_updates']): ?>
                        <?php echo render($page['homepage_twitter_updates']); ?>
                    <?php endif; ?>
                </div>

            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php include_once('includes/social-bar.php'); ?>

<?php include_once('includes/footer.php'); ?>

<script type="text/javascript">

    $(document).ready(function(){
        initQuizValidator();
    });

    var arrQuestions = [];
    function initQuizValidator(){
        $('.quiz-button-container .content a').addClass('btn btn-default btn-submit-transparent hidden').css('width',
            'auto');
        $(".questions-container").each(function(idx, value){
            var arrQuestionDetail = [];

            var id = $(this).attr('id');
            arrQuestionDetail['id'] = id;

            var fieldName = 'checkbox-question'+id.substr(0 -1);
            arrQuestionDetail['option_name'] = fieldName;

            var totalOptions = 0;
            var pathOptions = ".questions-container .question-options .option input[name='"+fieldName+"']";
            arrQuestionDetail['options_path'] = pathOptions;
            $(pathOptions).each(function(idxOption, vOption){
                totalOptions += 1;
            });
            arrQuestionDetail['options_total'] = totalOptions;
            arrQuestions[idx] = arrQuestionDetail;
        });
    }

    function validateQuiz() {
        var hasAnyUnchecked = false;
        $(arrQuestions).each(function(idx, value){
            var totalUnchecked = 0;
            $(value.options_path).each(function(idxOption, vOption){
                var isChecked = $(this).is(":checked");
                if(!isChecked){
                    totalUnchecked += 1;
                }
            });
            if(value.options_total == totalUnchecked){
                hasAnyUnchecked = true;
            }
        });
        if(hasAnyUnchecked){
            $("#quizErrorMessage").removeClass('hidden');
            $("body").scrollTop(300);
        } else {
            $("#quizErrorMessage").addClass('hidden');
            return true;
        }
    }

    function submitQuiz(){
        if(validateQuiz()) {
            var totalQuestionsPassed = 0;

            // Hide all messages at first
            $(".questions-container .alert").each(function (idx, v) {
                $(this).addClass('hidden');
            });
            $(".questions-container .option .icon").each(function (idx, v) {
                $(this).html('&nbsp;');
            });

            // Now auto find the correct answer to show appropriate message
            $('[type="radio"]:checked').each(function (index, v) {
                var element = $(v);
                var input = element.attr('name');

                var answer = $(v).val();
                var questionNumber = input.substr(0 - 1);
                var answerNumber = $("#question-" + questionNumber + "-answer").text();
                var message = '';
                if (answer == answerNumber) {
                    $("#question-" + questionNumber + " .alert-success").removeClass('hidden');
                    message = '<span class="correct"></span>';
                    totalQuestionsPassed += 1;

                } else if (answer !== answerNumber) {
                    $("#question-" + questionNumber + " .alert-danger").removeClass('hidden');
                    //message = '<span class="wrong"></span>';
                    // Also show the correct option as well
                    var correctOptionPath = '#question-'+questionNumber+' .question-options .option .desc [value="'+answerNumber+'"]';
                    var elementCorrectOption = $(correctOptionPath);
                    if(elementCorrectOption.attr('value') == answerNumber) {
                        var correctIcon = elementCorrectOption.parent().parent().find(".icon");
                        correctIcon.html('');
                        var correctMessage = '<span class="correct"></span>';
                        correctIcon.html(correctMessage);
                    }
                }

                var icon = element.parent().parent().find(".icon");
                icon.html('');
                icon.html(message);

                $("#submit").hide();
                $('.quiz-button-container .content a').removeClass('hidden');
                $("#connect-response-image").removeClass('hidden');
            });

            $("#connect-quiz-score-passed").text(totalQuestionsPassed);
            $("#connect-quiz-score-failed").text(arrQuestions.length);
        }
    }

    function validate_quiz(){
        $('#connect_question')
    }

    jQuery(window).load(
        function(){
            var head = $('iframe#twitter-widget-0').contents().find('head');
            if (head.length) {
                head.append('<style>.timeline { max-width: 100% !important; width: 100% !important; } .timeline .stream { max-width: none !important; width: 100% !important; }</style>');
            }
            $('#twitter-widget-0').append($('<div class=timeline>'));
        }
    )

</script>