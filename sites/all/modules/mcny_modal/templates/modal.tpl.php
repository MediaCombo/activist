<!-- Mcny Modal -->
<div class="modal fade hidden" id="mcny-modal" role="dialog" aria-labelledby="mcny-modal">

    <div id="mcny-modal-dialog" class="modal-dialog modal-lg" role="document">

        <!-- Modal Content -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div id="mcny-modal-header" class="modal-header default">
                <div class="text-left left">
                    <h4 id="mcny-modal-title" class="modal-title"></h4>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-close fa-1x" aria-hidden="true"></span>
                </button>
                <div class="text-right right">
                    <div id="mcny-modal-title-right-side" class="modal-title modal-title-category text-right">
                        <span id="mcny-modal-category-icon"></span>
                        <span id="mcny-modal-category-name" class="text-underline"></span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <!-- /Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Ajax Indicator -->
                <div class="mcny-modal-indicator text-center" id="mcny-modal-indicator">
                    <span class="fa fa-spinner fa-spin fa-2x"></span>
                </div>
                <!-- /Ajax Indicator -->

                <!-- Modal Response -->
                <div id="mcny-modal-response">
                    <div id="mcny-modal-wrapper" class="mcny-modal-wrapper">
                        <div class="mcny-modal-image-container">
                            <div class="mcny-modal-image">
                                <!-- Modal Image -->
                                <img id="activist-image" src="" class="">
                                <!-- Modal Player -->
                                <div id="audio-player-container" class="icon-audio-series-overlap fa-2x" style="position: absolute; top: 45%; left: 45%;">
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="mcny-modal-information">
                            <div id="mcny-modal-activist-title" class="title"></div>
                            <div id="mcny-modal-activist-year" class="year"></div>
                            <div id="mcny-modal-activist-body" class="text"></div>
                            <div id="mcny-modal-slides-container" class="mcny-modal-slides">
                                <div>
                                    <span class="margin-right-5">
                                        <img id="icon-image-series" src="">
                                    </span>
                                    <span>Images In This Series</span>
                                </div>
                                <div id="mcny-modal-activist-image-series-container" class="mcny-modal-slides-container">
                                    <img src="">
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div id="mcny-modal-wrapper-video"></div>
                </div>
                <!-- /Modal Response -->

                <!-- / Pagination & Slider -->
                <div id="mcny-modal-slider" class="mcny-modal-slider">
                    <div id="mcny-modal-slide-left" class="mcny-modal-slide-left">
                        <div id="mcny-modal-button-slide-previous" class="button-left"></div>
                    </div>
                    <div id="mcny-modal-slide-right" class="mcny-modal-slide-right">
                        <div id="mcny-modal-button-slide-next" class="button-right"></div>
                    </div>
                    <div class="clear"></div>
                    <input type="hidden" id="slide_number_current" name="slide_number_current" value="0">
                    <input type="hidden" id="slide_number_next" name="slide_number_next" value="0">
                    <input type="hidden" id="slide_number_previous" name="slide_number_previous" value="0">
                </div>
                <!-- / Pagination & Slider -->

            </div>
            <div class="modal-footer hidden"></div>
        </div>
        <!-- /Modal Content -->

    </div>
</div>
<!-- /Mcny Modal -->