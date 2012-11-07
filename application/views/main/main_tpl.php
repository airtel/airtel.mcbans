
<table class="table table-bordered table-striped table-condensed table-hover table-bans dTableR">
    
    <thead>
        <tr>
            <th>Lietotajvārds</th>
            <th>Iemesls</th>
            <th>Admins</th>
            <th>Uzlikts</th>
            <th>Līdz</th>
            <!--<th style="width: 60px">Darbība</th>-->
        </tr>
    </thead>
    
    <tbody>
        <?php
        if(count($bans) > 0):
            foreach($bans as $b):
                ?>
                <tr id="<?php echo $b->name; ?>">
                    <td><img alt="" src="http://minotar.net/avatar/<?php echo $b->name; ?>/19.png"> <strong><?php echo $b->name; ?></strong></td>
                    <td><?php echo $b->reason; ?></td>
                    <td><?php echo $b->admin; ?></td>
                    <td><?php echo date('d.m.Y', $b->time); ?></td>
                    <td><?php echo ($b->temptime > 0) ? date('d.m.Y', $b->temptime) : 'Mūžīgs'; ?></td>
                    <!--<td><button class="btn btn-mini btn-success" type="button">Noņemt</button></td>-->
                </tr>
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
    
</table>


<!-- Modal -->
<div id="paymentModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 id="paymentModalLabel">Noņemt banu lietotājam: <span id="modalUsername"></span></h4>
    </div>
    
    <div class="modal-body">
        
        <div id="alert-area"></div>
        
        <?php echo $this->ui->show_payment_block(); ?>
    </div>
    
</div>