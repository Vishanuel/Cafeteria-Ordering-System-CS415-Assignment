<?php $__env->startSection('content'); ?>
<section class="content-header">
    
</section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border text-center">
                <h3 class="box-title">Special Menus</h3>
                <a  target="_blank" href="<?php echo e(url('Mhelp/ViewingSpecialMenu.html')); ?>" class="pull-right" title="Get Help">
                    <span class="glyphicon glyphicon-question-sign"></span>
                </a>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id ="example1">
                <tr>
                    <th>Menu Date</th>
                    <th>Menu Item</th>
                    <th>Item Description</th>
                    <th>Item Price</th>
                    <th>Action</th>
                </tr>
                <?php for($i=0;$i<count($data);$i++): ?>
                <tr>
                    <td >
                    <?php echo e($data[$i]->Menu_Date); ?>

                    </td>
                <?php for($k=0;$k<1;$k++): ?>
                    <td >
                        <?php for($j=0;$j<count($val[$i]);$j++): ?>
                        <div><?php echo e($val[$i][$j]->Food_Name); ?></div>
                        <?php endfor; ?>
                    </td>
                    <td >
                        <div><?php echo e($data[$i]->Special_Desc); ?></div>
                    </td>
                    <td >
                        <div><?php echo e($data[$i]->Special_Price); ?></div>
                    </td>
                <?php endfor; ?>
                    <td>
                        <a data-toggle="modal" data-target="#edit<?php echo e($data[$i]->Special_ID); ?>">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a> 
                        <a data-toggle="modal" data-target="#delete<?php echo e($data[$i]->Special_ID); ?>">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>

                    <div class="modal fade" id="edit<?php echo e($data[$i]->Special_ID); ?>" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <form method="post" action="<?php echo e(route('specialmenu.update', $data[$i]->Special_ID)); ?>" enctype="multipart/form-data">
                                    <?php echo method_field('PATCH'); ?> 
                                     <?php echo csrf_field(); ?>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Edit Special Menu</h4>
                                    </div>
                                    <div class="modal-body">
                                            <div class="form-group">
                                                    <label for="menus">Menu </label>
                                                    
                                                    <select id="menus" name="menu" class="form-control" required>
                                                        <option value=""></option>
                                                        <?php for($j=0;$j<count($menu);$j++): ?>
                                                        <option value="<?php echo e($menu[$j]->Menu_ID); ?>"  <?php if($menu[$j]->Menu_ID == $data[$i]->Menu_ID): ?> selected="selected"<?php endif; ?>>
                                                            <?php echo e($menu[$j]->Menu_Date); ?> 
                                                            <?php for($k=0;$k<count($menuitem[$j]);$k++): ?>
                                                             - <?php echo e($menuitem[$j][$k]->Food_Name); ?>

                                                            <?php endfor; ?>
                                                            - <?php echo e($menu[$j]->Category_Name); ?>

                                                        </option>
                                                        <?php endfor; ?>
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Special Menu Description</label>
                                                <input type="text" class="form-control" name="menu_desc" value="<?php echo e($data[$i]->Special_Desc); ?>" required>
                                              </div>
                                              <div class="form-group">
                                                    <label>Special Menu Price</label>
                                                    <input type="number" class="form-control" min="0" name="menu_price" value="<?php echo e($data[$i]->Special_Price); ?>" required>
                                              </div>
                                             
                                              <label> Menu Items </label>
                                              <?php for($k=0;$k<count($items);$k++): ?>
                                              <div class="checkbox">
                                            <label><input type="checkbox" name="items[]" value="<?php echo e($items[$k]->Menu_Food_Item_ID); ?>" 
                                              <?php for($n=0;$n<count($val[$i]);$n++): ?>
                                                      <?php if(($val[$i][$n]->Menu_Food_Item_ID)==($items[$k]->Menu_Food_Item_ID)): ?>  ? checked : 
                                                      <?php endif; ?> <?php endfor; ?>>
                                             <?php echo e($items[$k]->Food_Name); ?></label>
                                              </div>
                                              <?php endfor; ?>    
                                             
                                            </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-flat pull-right">Update</button>
                                    </div>
                                </form>
                                
                         </div>
                       </div>
                    </div>

                    <div class="modal fade" id="delete<?php echo e($data[$i]->Special_ID); ?>" >
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <form method="post" action="<?php echo e(route('specialmenu.destroy', $data[$i]->Special_ID)); ?>" enctype="multipart/form-data">
                                     <?php echo csrf_field(); ?>
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Delete Special Menu</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p> Do you really want to delete this special menu?</p>
                                        <input name="_method" type="hidden" value="DELETE">     
                                      
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-flat pull-right">delete</button>
                                    </div>
                                </form>
                                
                         </div>
                       </div>
                    </div>
                    
                </tr>
                 <?php endfor; ?>
                </table>
                <a data-toggle="modal" data-target="#add">
                        <span class="glyphicon glyphicon-plus pull-right" title="click to add or create new special menus"></span>
                    </a>

                    <div class="modal fade" id="add" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                    <form method="post" action="<?php echo e(route('specialmenu.store')); ?>" enctype="multipart/form-data">
                                         <?php echo csrf_field(); ?>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span >&times;</span></button>
                                            <h4 class="modal-title">Create New Special Menu</h4>
                                        </div>
                                        <div class="modal-body">
                                                 <div class="form-group">
                                                    <label for="menus">Menu </label>
                                                    
                                                    <select id="menus" name="menu" class="form-control" required>
                                                        <option value=""></option>
                                                        <?php for($j=0;$j<count($menu);$j++): ?>
                                                        <option value="<?php echo e($menu[$j]->Menu_ID); ?>"><div><?php echo e($menu[$j]->Menu_Date); ?> 
                                                            <?php for($k=0;$k<count($menuitem[$j]);$k++): ?>
                                                             - <?php echo e($menuitem[$j][$k]->Food_Name); ?>

                                                            <?php endfor; ?>
                                                            - <?php echo e($menu[$j]->Category_Name); ?></div>
                                                        </option>
                                                        <?php endfor; ?>
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Special Menu Description</label>
                                                    <input type="text" class="form-control" name="menu_desc" required>
                                              </div>
                                              <div class="form-group">
                                                    <label>Special Menu Price</label>
                                                    <input type="number" min="0" class="form-control" name="menu_price" required>
                                              </div>
                                             
                                              <label> Menu Items </label>
                                              <?php for($k=0;$k<count($items);$k++): ?>
                                              <div class="checkbox">
                                                <label><input type="checkbox" name="items[]" value="<?php echo e($items[$k]->Menu_Food_Item_ID); ?>">
                                              <?php echo e($items[$k]->Food_Name); ?></label>
                                              </div>
                                              <?php endfor; ?>    
                                             
                                            </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success btn-flat pull-right">Save</button>
                                        </div>
                                    </form>
                             </div>
                           </div>
                    
                        
            </div>
    
    </section>
     



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/menu manager/display_specials.blade.php ENDPATH**/ ?>