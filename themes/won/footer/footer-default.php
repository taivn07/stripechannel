<footer class="footer footer_lg">
    <div class="container">
        <div class="footer__inner border-t_prim">
            <div class="row">
                <div class="col-sm-6">

                    <?php if( is_active_sidebar('footer_left') ){ ?>
						   <?php  dynamic_sidebar('footer_left'); ?>
					<?php } ?>

                </div>
                <div class="col-sm-6">
                    <div class="text-right text-right_sm">
                        <?php if( is_active_sidebar('footer_right') ){ ?>
						   <?php  dynamic_sidebar('footer_right'); ?>
					<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
        $(document).ready(function() {
            $('#fullpage').fullpage({
                'verticalCentered': false,
                'css3': true,
                'sectionsColor': ['#F0F2F4', '#fff', '#fff', '#fff'],
                'navigation': true,
                'navigationPosition': 'right',
                'navigationTooltips': ['fullPage.js', 'Powerful', 'Amazing', 'Simple'],

                'afterLoad': function(anchorLink, index){
                    if(index == 2){
                        $('#iphone3, #iphone2, #iphone4').addClass('active');
                    }
                },

                'onLeave': function(index, nextIndex, direction){
                    if (index == 3 && direction == 'down'){
                        $('.section').eq(index -1).removeClass('moveDown').addClass('moveUp');
                    }
                    else if(index == 3 && direction == 'up'){
                        $('.section').eq(index -1).removeClass('moveUp').addClass('moveDown');
                    }

                    $('#staticImg').toggleClass('active', (index == 2 && direction == 'down' ) || (index == 4 && direction == 'up'));
                    $('#staticImg').toggleClass('moveDown', nextIndex == 4);
                    $('#staticImg').toggleClass('moveUp', index == 4 && direction == 'up');
                }
            });
        });
    </script>