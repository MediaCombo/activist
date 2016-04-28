<div class="row">
    <div class="container">
        <div class="col-lg-12 no-padding-lr">
            <div class="timeline-data timeline-wrapper margin-top-40">
                <h2>Key Events</h2>
                <div class="left-heading sub-heading">Global Events</div>
                <div class="right-heading sub-heading">Local Events</div>
                <div class="seprator">
                    <span class="sep-top"></span>
                    <span class="sep-bottom"></span>
                </div>
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        hideRepeatedYears('item-a');
        hideRepeatedYears('item-b');

        hideRepeatedYears('timelineOneColumn');
        hideRepeatedYears('timelineOneColumn');

    });

    function hideRepeatedYears(classContainer){
        var yearUsed = '';
        var sideUsed = '';
        $("."+classContainer+">p>span.date-display-single").each(function(idx, value){
            var spanYear = $(this);
            var year = spanYear.text();
            var side = spanYear.parent().parent().attr('class');
            if(year !== yearUsed){
                yearUsed = year;
                sideUsed = side;
            }
            else {
                spanYear.css({'visibility': 'hidden'});
            }
        });
    }

    $('#more_timeline').click(
        function(){
            var moreArrow = this;
            $('.more-timeline-items').slideToggle('fast', function(){
                if($(moreArrow).hasClass('timeline-more')) {
                    $('.timeline-wrapper .view-content > .item-row').last().removeClass('timeline-padding-last');
                    $(moreArrow).removeClass('timeline-more').addClass('timeline-less');
                } else {
                    $('.timeline-wrapper .view-content > .item-row').last().addClass('timeline-padding-last');
                    $(moreArrow).removeClass('timeline-less').addClass('timeline-more');
                }
            });
        }
    );
</script>