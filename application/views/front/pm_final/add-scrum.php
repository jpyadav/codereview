<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php

$this->load->view('front/include/header');

$this->load->view('front/include/sidebar');

?>

<div id="page_content">

  <div id="page_content_inner">
    
    <h3 class="heading_b uk-margin-bottom">Add Project</h3>
 <div class="uk-grid uk-grid-medium" data-uk-grid-margin="" data-uk-grid-match="{target:'.md-card'}">
         <div class="uk-width-medium-2-3">

            <div class="md-card">

                <div class="md-card-content large-padding">

                    <form id="form_validation" class="uk-form-stacked"  action="<?php echo base_url('Scrum/add_action');?>" method="post"  >

                        <div class="uk-grid  data-uk-grid-margin">

                            <div class="uk-width-medium-1-1">

                                <?php if($this->session->flashdata('FAILED')){?>

                                <div class="alert alert-danger" style="margin-left:0px"><?=$this->session->flashdata('FAILED');?></div>

                                <?php }?>

                             <?php if($this->session->flashdata('SUCCESS')){?>

                                <div class="alert alert-success" style="margin-left:0px"><?=$this->session->flashdata('SUCCESS');?></div>

                                <?php }?>

                            </div>

                            

                        </div>

                <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-1">

                                <div class="parsley-row">

                                    <label for="proj_name">Project name<span class="req">*</span></label>

                                    <input type="text" name="proj_name" value="<?php echo set_value('proj_name'); ?>"  data-parsley-trigger="change" required  class="md-input" />

                                    <?php if(form_error('proj_name')){?><div class="inline-label uk-badge uk-badge-danger hover"><?php echo form_error('proj_name'); ?></div><?php } ?>

                                </div>

                            </div>

                            </div>
                              <div class="uk-grid" data-uk-grid-margin>

                        <div class="uk-width-medium-1-1">

                                <div class="parsley-row">

                                    <label for="proj_desc">Project description<span class="req">*</span></label>

                                    <input type="text" name="proj_desc" value="<?php echo set_value('proj_desc'); ?>"  data-parsley-trigger="change" required  class="md-input" />

                                    <?php if(form_error('proj_desc')){?><div class="inline-label uk-badge uk-badge-danger hover"><?php echo form_error('proj_desc'); ?></div><?php } ?>

                                </div>

                            </div>

                            </div>

                              <div class="uk-grid" data-uk-grid-margin>

                           <div class="uk-width-medium-1-1">

                                <div class="parsley-row">

                                    <label for="proj_team">Project Team</label>

                                   

                                    <select multiple name="proj_team[]" id="proj_team" data-parsley-trigger="change"   class="md-input" >
                                          <?php foreach($user_name as $user)
            {
               ?>
               <option value='<?php echo $user->user_id; ?>'><?php echo $user->name; ?></option>

         <?php   } ?>
                                    </select>

                                    <?php if(form_error('proj_team')){?>
                                    <div class="inline-label uk-badge uk-badge-danger hover" >
                                    <?php echo form_error('proj_team'); ?></div><?php } ?>

                                </div>

                            </div>

                            </div>

                            <div class="uk-grid" data-uk-grid-margin>

                             <div class="uk-width-medium-1-1">

                                <div class="parsley-row">

                                    <label for="dept">Department assigned</label>

                                    
                                    <select  name="dept" id="dept" data-parsley-trigger="change"   class="md-input"  >
                                           
                                         <?php foreach($dept_name as $dept)
            {
               ?>
               <option value='<?php echo $dept->dept_id; ?>'><?php echo $dept->dept_name; ?></option>

         <?php   } ?>  
                                    </select>

                                    <?php if(form_error('dept')){?><div class="inline-label uk-badge uk-badge-danger hover"><?php echo form_error('state'); ?></div><?php } ?>

                                </div>

                            </div>



                            </div>

                            <div class="uk-grid" data-uk-grid-margin>
                                <div class="uk-width-medium-1-1">
                                
                              
                                    <div class="uk-grid">
                                        <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <div class="md-input-wrapper"><label for="start_date">Start date</label>
                                                <input class="md-input" type="text" name="start_date" id="start_date" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                                  <?php if(form_error('start_date')){?><div class="inline-label uk-badge uk-badge-danger hover">
                                                <?php echo form_error('start_date'); ?></div><?php } ?>

                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="uk-grid">
                                        <div class="uk-width-large-1-2 uk-width-medium-1-1">
                                            <div class="uk-input-group">
                                                <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                                <div class="md-input-wrapper"><label for="deadline">Deadline</label>
                                                <input class="md-input" type="text" name="deadline" id="deadline" data-uk-datepicker="{format:'YYYY-MM-DD'}">
                                                </div>
                                                  <?php if(form_error('deadline')){?><div class="inline-label uk-badge uk-badge-danger hover">
                                                <?php echo form_error('deadline'); ?></div><?php } ?>

                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

          

                        <div class="uk-grid">

                            <div class="uk-width-1-1">

                                <button type="submit" class="md-btn md-btn-primary">Submit</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>
 
</div>

            

</div>

        </div>

</div>


 <script>

        WebFontConfig = {

            google: {

                families: [

                    'Source+Code+Pro:400,700:latin',

                    'Roboto:400,300,500,700,400italic:latin'

                ]

            }

        };

        (function() {

            var wf = document.createElement('script');

            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +

            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';

            wf.type = 'text/javascript';

            wf.async = 'true';

            var s = document.getElementsByTagName('script')[0];

            s.parentNode.insertBefore(wf, s);

        })();

    </script>



    <!-- common functions -->

    <script src="<?=base_url('asset/js/common.min.js');?>"></script>

    <!-- uikit functions -->

    <script src="<?=base_url('asset/js/uikit_custom.min.js');?>"></script>

    <!-- altair common functions/helpers -->

    <script src="<?=base_url('asset/js/altair_admin_common.min.js');?>"></script>



    <!-- page specific plugins -->

    <!-- parsley (validation) -->

    <script>

    // load parsley config (altair_admin_common.js)

    altair_forms.parsley_validation_config();

    </script>

    <script src="<?=base_url('asset/bower_components/parsleyjs/dist/parsley.min.js');?>"></script>



    <!--  forms validation functions -->

    <script src="<?=base_url('asset/js/pages/forms_validation.min.js');?>"></script>

    

    <script>

        $(function() {

            // enable hires images

            altair_helpers.retina_images();

            // fastClick (touch devices)

            if(Modernizr.touch) {

                FastClick.attach(document.body);

            }

        });

    </script>

<script type="text/javascript">
function add(obj)
{
    var id=obj.id.split('_')[2];
        alert(id);

    $('#last_question_no').val(parseInt(id)+1);
    $('#question_b_'+id).before('<input name="question_'+(parseInt(id)+1)+'" id="question_'+(parseInt(id)+1)+'" type="text" data-parsley-trigger="change"  class="md-input">');
    obj.id="question_b_"+(parseInt(id)+1);

}


   
</script>





</body>

</html>