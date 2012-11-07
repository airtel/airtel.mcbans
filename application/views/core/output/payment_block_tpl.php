<?php
echo form_open(site_url('main/unban'), array('id' => 'unban-payment', 'class' => 'form-horizontal well', 'autocomplete' => 'off'));
    ?>
    <fieldset>

        <div class="tabbable tabbable-bordered">
            <ul id="pay_tabs" class="nav nav-tabs">

                <?php
                $i = 1;
                foreach($this->module->pay_methods as $pay_method):
                    ?>
                    <li class="<?php echo ($i == 1) ? 'active' : ''; ?>">
                        <a href="#tab_br<?php echo $i; ?>" data-toggle="tab">
                            <i class="payment <?php echo $pay_method; ?>"></i><?php echo $this->module->pay_options[$pay_method]['name']; ?>
                        </a>
                    </li>
                    <?php
                    $i++;
                endforeach;
                ?>

            </ul>
        
            <div class="tab-content">
                
                <?php
                $i = 1;
                foreach($this->module->pay_methods as $pay_method):
                    ?>
                    <div class="tab-pane <?php echo ($i == 1) ? 'active' : ''; ?>" id="tab_br<?php echo $i; ?>" style="min-height: 225px;">

                        <?php
                        foreach($this->config->item('fields_'.$pay_method) as $field => $options):

                            $form_error = form_error($field);
                            ?>

                            <div class="control-group <?php echo ( ! empty($form_error)) ? 'error f_error' : ''; ?>">
                                <label class="control-label"><?php echo $options['label']; ?>:</label>
                                <div class="controls">

                                    <?php

                                    if($options['type'] == 'input')
                                    {
                                        $options['options']['class'] = $options['ajax_validation'];
                                        echo form_input($options['options']);
                                    }

                                    elseif($options['type'] == 'text')
                                    {
                                        echo '<label class="input-label"><strong>';
                                        if($pay_method == 'sms')
                                        {
                                            echo $this->module->sms_prices[$this->config->item($pay_method, 'unban_price')] . ' ' . $this->config->item('lv', 'currency');
                                        }
                                        else
                                        {
                                            echo '<span id="'.$pay_method.'_key">' .$this->config->item($pay_method, 'unban_price') . '</span> ' . $this->module->pay_options[$pay_method]['currency'];
                                        }
                                        echo '</strong></label>';
                                    }

                                    elseif($options['type'] == 'dropdown')
                                    {

                                        if($field == 'prices_'.$pay_method)
                                        {
                                            $options['data'] = array();
                                        }
                                        elseif($field == 'countries')
                                        {
                                            $options['data'] = $this->config->item('countries');
                                        }

                                        echo form_dropdown($field, $options['data'], $options['value'], $options['options']);
                                    }

                                    // CI error reporting
                                    echo ( ! empty($form_error)) ? '<label class="error" for="'.$field.'" generated="true">'.$form_error.'</label>' : ''; 

                                    ?>

                                </div>
                            </div>

                            <?php

                        endforeach;

                        if($pay_method == 'sms'):

                            echo $this->ui->sms_sendto('200', $this->module->sms_prices); 

                        else:
                            
                            ?>
                        
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                    <strong><a rel="tooltip" title="Ātrais apmaksas veids. <?php echo $pay_method; ?> kods ir pieejams uzreiz pēc apmaksas." id="airtel_<?php echo $pay_method; ?>_system" href="#">Iegādāties airtel <?php echo $pay_method; ?> kodu <i class="icon-external-link"></i></a></strong>
                                </div>
                            </div>
                        
                            <?php

                        endif;

                        ?>


                        
                        
                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
                
            </div>
            



            

        </div>
        
        <div class="control-button">
             <button type="submit" class="btn btn-primary do-process" data-loading-text="Uzgaidi..."><i class="icon-unlock"></i> Veikt apmaksu</button>
        </div>
        

    </fieldset>

    <?php
    echo form_hidden('username', '');
    echo form_hidden('submit-form', 'submit-form');
    
echo form_close()
?>