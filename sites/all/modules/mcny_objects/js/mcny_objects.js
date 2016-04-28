(function ($) {
    Drupal.behaviors.objects_and_images = {
        attach: function (context) {
            var settings = Drupal.settings;

            $(".mcny-modal-objects").each(function (idx, r) {
                // Auto bind the attributes to execute modal on click
                $(this).attr('data-toggle', 'modal');
                $(this).attr('data-target', '#mcny-modal');
                // Auto bind the click event to execute the modal
                $(this).click(function () {
                    $("#mcny-modal-dialog").focus();
                    var currentObject = $(this);
                    $('#mcny-modal-activist-heading').text('Objects & Images');
                    var currentId = currentObject.attr('data-id');
                    var nextId = currentObject.attr('data-id-next');
                    var previousId = currentObject.attr('data-id-previous');
                    mcnyLoadObject(currentId, nextId, previousId, settings);
                });
            });

            var max_slides = 4;
            var object_slider = $('#bxslider-objects').bxSlider({
                minSlides: 1,
                maxSlides: max_slides,
                slideWidth: 225,
                easing: "linear",
                infiniteLoop: false,
                hideControlOnEnd: true,
                pager: false
            });

            if (object_slider.getSlideCount == 'function') {
                if (object_slider.getSlideCount() <= max_slides) {
                    $('.objects-slides .bx-controls').addClass('hide_large');
                }
            }
        }
    };
})(jQuery);

var isPlayingActivistTrack = false;
var activistAudio = '';

/**
 *  Auto initialize the modal data with all desired behaviors for each request
 */
function mcnyLoadObject(currentId, nextId, previousId, settings) {

    stopTrack();

    $("#mcny-modal").removeClass("hidden");
    //$("#mcny-modal-title").text('Loading...');
    //$("#mcny-modal-title-right-side").hide();

    $("#mcny-modal-indicator").show();
    $("#mcny-modal-response").hide();

    $("#mcny-modal-wrapper-video").hide();
    $("#mcny-modal-wrapper-video").html('');

    $("#slide_number_current").attr('value', currentId);
    $("#slide_number_next").attr('value', nextId);
    $("#slide_number_previous").attr('value', previousId);

    // Hide slider buttons, thumbnail series and make description to long by default as well
    $("#mcny-modal-slider").addClass('hidden');
    $("#mcny-modal-slides-container").hide();
    $("#mcny-modal-activist-body").addClass('auto');

    // Reset image source on load
    $("#activist-image").attr('src', '');

    // Reusable image paths
    var moduleImagesDir = settings.basePath + 'sites/all/modules/mcny_modal/images/';
    var imageStoragePath = settings.basePath + 'sites/default/files/objects/';

    // Case study title, category and icon to show in modal
    var caseStudyTitle = $("#case-study-page-title").text();
    var caseStudyCategoryIcon = $("#case-study-category-icon").attr('src');
    var caseStudyCategoryName = $("#case-study-category-name").text();

    // Fetch object specific information such as image and more
    var requestUrl = settings.basePath + "ajax/open_objects_modal";

    var request = $.ajax({
        method: "POST",
        url: requestUrl,
        data: {id: currentId},
        dataType: "json"
    });

    request.done(function (data) {
        var rs = data[currentId];

        $("#mcny-modal-slider").removeClass('hidden');
        var hasNext = $("#slide_number_next").attr('value');
        if (hasNext == '' || hasNext == null) {
            $("#mcny-modal-button-slide-next").addClass('hidden');
        } else {
            $("#mcny-modal-button-slide-next").removeClass('hidden');
        }

        var hasPrevious = $("#slide_number_previous").attr('value');
        if (hasPrevious == 0 || hasPrevious == '' || hasPrevious == null) {
            $("#mcny-modal-button-slide-previous").addClass('hidden');
        } else {
            $("#mcny-modal-button-slide-previous").removeClass('hidden');
        }

        // Modal title, category icon and name
        $("#mcny-modal-title").html(caseStudyTitle);
        var categoryIconImage = '<img src="' + caseStudyCategoryIcon + '">';
        $("#mcny-modal-category-icon").html(categoryIconImage);
        $("#mcny-modal-category-name").html(caseStudyCategoryName);

        // Title, category, description and etc
        var titleObjectName = (rs.field_object_name['und'] !== undefined) ? rs.field_object_name['und'][0]['value'] : '';
        var titleObject = (typeof rs !== undefined) ? titleObjectName : '';
        var descriptionObject = (rs.body['und'][0]['value']) ? rs.body['und'][0]['value'] : '';
        $("#mcny-modal-activist-title").text(titleObject);
        $("#mcny-modal-activist-body").html(descriptionObject);

        // Object image
        var thumbnail = rs.field_object_image['und'][0]['filename'];
        var thumbnail_scaled = rs.field_object_image['und'][0]['uri_scaled'];
        $("#activist-image").attr('src', thumbnail_scaled); // imageStoragePath+thumbnail
        $("#activist-image").attr('title', rs.field_object_image['und'][0]['title']);
        $("#activist-image").attr('alt', rs.field_object_image['und'][0]['alt']);

        // Object image switch overlap icon
        $("#icon-image-series").attr('src', moduleImagesDir + 'icon-images.png');
        $("#icon-image-series").attr('onclick', 'showDefaultObjectThumbnail()');
        $("#icon-image-series").attr('data-image-default', thumbnail_scaled);

        // Thumbnails in series
        var imageSeries = "";
        if (rs.field_object_image_gallery['und'] != undefined) {
            var totalImagesInSeries = 0;
            for (var i = 0; i < rs.field_object_image_gallery['und'].length; i++) {
                // Thumbnail
                var imageSeriesThumbnail = imageStoragePath + rs.field_object_image_gallery['und'][i]['filename'];
                var imageSeriesThumbnailTitle = (rs.field_object_image_gallery['und'][i]['title'] !== null) ? rs.field_object_image_gallery['und'][i]['title'] : '';
                var imageSeriesThumbnailAlt = (rs.field_object_image_gallery['und'][i]['alt'] !== null) ? rs.field_object_image_gallery['und'][i]['alt'] : '';
                imageSeries += '<img id="mcny-modal-slide-' + i + '" src="' + imageSeriesThumbnail + '" alt="'+imageSeriesThumbnailAlt+'" title="'+imageSeriesThumbnailTitle+'" class="mcny-modal-slide-thumbnail" onclick="mcnyShowSeriesImageObject(' + i + ',' + totalImagesInSeries + ');">';
                totalImagesInSeries++;
            }
            $("#mcny-modal-activist-body").removeClass('auto');
            $("#mcny-modal-slides-container").show();

            // Show slider buttons if thumbnail series exists
            //if(totalImagesInSeries >= 1){
            //$("#mcny-modal-slider").removeClass('hidden');
            //}
        }
        $("#mcny-modal-activist-image-series-container").html(imageSeries);

        // Initialize audio player
        $("#activist-audio-player").remove();
        var audioPlayerHtml = '';
        var audioFile = (typeof rs.field_object_audio_file['und'] != 'undefined') ? rs.field_object_audio_file['und'][0]['filename'] : null;
        if (audioFile) {
            var filePath = settings.basePath + 'sites/default/files/audio-files-objects/' + audioFile;
            audioPlayerHtml = '<div id="activist-audio-player">';
            audioPlayerHtml += '<audio id="activist-audio-file" class="audio-file" preload="none" onplay="playingTrack()" onended="endTrack();"><source src="' + filePath + '" type="audio/mpeg">Your browser does not support the audio element.</audio>';
            audioPlayerHtml += '<a href="javascript:;" id="audioPlay" class=""><span id="audioPlayIcon" class="fa fa-play fa-2x"></span></a>';
            audioPlayerHtml += '</div>';
            $("#audio-player-container").html(audioPlayerHtml);
            activistAudio = document.getElementById('activist-audio-file');
            initTrack();
        }

        // Initialize or add the video play button if exists
        var videoFile = (typeof rs.field_object_video_file['und'] != 'undefined') ? rs.field_object_video_file['und'][0]['filename'] : null;
        if (videoFile) {
            if (!audioFile) {
                audioPlayerHtml = '<div id="activist-audio-player">';
                audioPlayerHtml += '</div>';
                $("#audio-player-container").html(audioPlayerHtml);
            }
            var _filePathVideo = settings.basePath + 'sites/default/files/video-files-object/' + videoFile;
            var filePathVideo = 'javascript:;';
            audioPlayerHtml = '<a href="' + filePathVideo + '" data-path="'+_filePathVideo+'" target="_blank" id="videoPlay" class="margin-left-15" onclick="playObjectVideo(this);"><span id="videoPlayIcon" class="fa fa-play-circle fa-2x"></span></a>';
            if (audioFile && videoFile) {
                $("#audio-player-container").css({'left': '40%'});
            }
            $("#activist-audio-player").append(audioPlayerHtml);
        }

        // Change slides per new object
        var newNextId = $("a[data-id='" + currentId + "']").attr('data-id-next');
        var newCurrentId = $("a[data-id='" + newNextId + "']").attr('data-id');
        var newPreviousId = $("a[data-id='" + newNextId + "']").attr('data-id-previous');

        mcnyChangeSlidePerObject(newCurrentId, newNextId, newPreviousId, settings);

        // Hide indicator and show modal
        $("#mcny-modal-indicator").hide();
        //$("#mcny-modal-title-right-side").show();
        $("#mcny-modal-wrapper").show();
        $("#mcny-modal-response").show();
    });
}

function showDefaultObjectThumbnail() {
    var defaultImagePath = $("#icon-image-series").attr('data-image-default');
    $("#activist-image").attr('src', defaultImagePath);
    $("#audioPlay").show();
}

function initTrack() {
    if (typeof activistAudio != 'undefined') {
        $("#audioPlay").unbind();
        $("#audioPlay").click(function () {
            playTrack();
        });
        // On modal close event
        $('#mcny-modal').on('hidden.bs.modal', function () {
            stopTrack();
        })
    }
}

function stopTrack() {
    if (typeof activistAudio.pause != 'undefined') {
        activistAudio.pause();
        activistAudio.src = '';
    }
    $("#activist-audio-player").remove();
    isPlayingActivistTrack = false;
}

function playingTrack() {
    isPlayingActivistTrack = true;
}

function playTrack() {
    if (isPlayingActivistTrack == true) {
        activistAudio.pause();
        $("#audioPlayIcon").removeClass("fa-pause");
        $("#audioPlayIcon").addClass("fa-play");
        isPlayingActivistTrack = false;
    }
    else if (isPlayingActivistTrack == false) {
        activistAudio.play();
        $("#audioPlayIcon").removeClass("fa-play");
        $("#audioPlayIcon").addClass("fa-pause");
        isPlayingActivistTrack = true;
    }
}

function stopTrack() {
    stopTrackOnly();
    $("#activist-audio-player").remove();
}

function stopTrackOnly(){
    if (typeof activistAudio.pause != 'undefined') {
        activistAudio.pause();
    }
    endTrack();
}

function endTrack() {
    $("#audioPlayIcon").removeClass("fa-pause");
    $("#audioPlayIcon").addClass("fa-play");
    isPlayingActivistTrack = false;
}

function playObjectVideo(obj) {
    stopTrackOnly();

    var width = $("#mcny-modal-wrapper").width();
    var height = $("#mcny-modal-wrapper").height();
    height = height - 38;
    if(jQuery.browser.mobile) {
        height = 'auto';
    }
    var videoUrl = $('#videoPlay').attr('data-path');

    var iFrameHtml = '<div id="mcny-modal-wrapper-video-back" class="pull-right"><a href="javascript:;" onclick="closeObjectVideo()"><span class="fa fa-reply video-back-icon"></span> Back</a></div>';
    iFrameHtml += '<iframe frameborder="0" src="'+videoUrl+'" height="'+height+'" width="'+width+'"></iframe>';

    $("#mcny-modal-wrapper").hide();
    $("#mcny-modal-wrapper-video").html(iFrameHtml);
    $("#mcny-modal-wrapper-video").show();
}

function closeObjectVideo(){
    $("#mcny-modal-wrapper-video").hide();
    $("#mcny-modal-wrapper-video>iframe").attr('src', '');
    $("#mcny-modal-wrapper-video").html('');
    $("#mcny-modal-wrapper").show();
}

/**
 *  Change the slides per object
 */
function mcnyChangeSlidePerObject(currentId, nextId, previousId, settings) {
    $("#mcny-modal-button-slide-next").unbind('click');
    $("#mcny-modal-button-slide-previous").unbind('click');
    // Next
    $("#mcny-modal-button-slide-next").on('click', function () {
        var current = $("#slide_number_current").attr('value');
        var next = $("#slide_number_next").attr('value');
        var previous = $("#slide_number_previous").attr('value');
        var newNext = $("a[data-id='" + next + "']").attr('data-id-next');
        var newPrevious = $("a[data-id='" + next + "']").attr('data-id-previous');
        mcnyLoadObject(next, newNext, newPrevious, settings);
    });
    // Previous
    $("#mcny-modal-button-slide-previous").on('click', function () {
        var current = $("#slide_number_current").attr('value');
        var next = $("#slide_number_next").attr('value');
        var previous = $("#slide_number_previous").attr('value');
        var newPrevious = $("a[data-id='" + previous + "']").attr('data-id-previous');
        mcnyLoadObject(previous, current, newPrevious, settings);
    });
}

/**
 *  Show Series Image
 *  - Renders the desired slide image on click event
 */
function mcnyShowSeriesImageObject(id, totalImagesInSeries) {
    id = parseInt(id);
    var srcSlideImage = $("#mcny-modal-slide-" + id).attr('src');
    $("#activist-image").attr('src', srcSlideImage);
    //var currentSlideNo = (id);
    //if(currentSlideNo < totalImagesInSeries) {
    //    $("#slide_number_current").val(currentSlideNo);
    //    $("#slide_number_next").val(currentSlideNo + 1);
    //}
    $(".mcny-modal-slide-thumbnail").removeClass('active');
    $("#mcny-modal-slide-" + id).addClass('active');
    //$("#audioPlay").hide();
}