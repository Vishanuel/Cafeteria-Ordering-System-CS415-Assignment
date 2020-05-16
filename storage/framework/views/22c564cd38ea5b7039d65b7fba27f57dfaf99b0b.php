<?php $__env->startSection('content'); ?>
<section class="content-header text-center"></section>
    <section class="content">
            <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Menu Items</h3>
                    </div>

                    <div class="box-body ">
                    <table class="table table-bordered table-striped text-center" id ="example1">
                    <tr>
                        <th>Item Name</th>
                        <th>Item Description</th>
                        <th>Item Price</th>
                        <th>Action</th>
                    </tr>
                        <?php for($i=0;$i<count($dish);$i++): ?>
                        <tr>
                            <td >
                                <?php echo e($dish[$i]->Food_Name); ?>

                            </td>
                            <td >
                                <?php echo e($dish[$i]->Food_Desc); ?>

                            </td>
                            <td >
                                <?php echo e($dish[$i]->Price); ?>

                            </td>
                           
                            <td >
                                <a data-toggle="modal" data-target="#<?php echo e($dish[$i]->Menu_Food_Item_ID); ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete<?php echo e($dish[$i]->Menu_Food_Item_ID); ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                                <div class="modal fade" id="<?php echo e($dish[$i]->Menu_Food_Item_ID); ?>" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <form method="post" action="<?php echo e(route('item.update', $dish[$i]->Menu_Food_Item_ID)); ?>" enctype="multipart/form-data">
                                                <?php echo method_field('PATCH'); ?> 
                                                 <?php echo csrf_field(); ?>
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span >&times;</span></button>
                                                    <h4 class="modal-title">Edit Menu Item</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Item Name</label>
                                                        <input type="text" class="form-control" name="item_name" value="<?php echo e($dish[$i]->Food_Name); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Item Description</label>
                                                        <input type="text" class="form-control" name="item_desc"value="<?php echo e($dish[$i]->Food_Desc); ?>" required>
                                                  </div>
                                                  <div class="form-group">
                                                          <label>Item Price</label>
                                                          <input type="text" class="form-control" name="item_price" value="<?php echo e($dish[$i]->Price); ?>" required>
                                                  </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-flat pull-right">Update</button>
                                                </div>
                                            </form>
                                            
                                     </div>
                                   </div>
                                </div>

                                <div class="modal fade" id="delete<?php echo e($dish[$i]->Menu_Food_Item_ID); ?>" >
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                                <form method="post" action="<?php echo e(route('item.destroy',$dish[$i]->Menu_Food_Item_ID)); ?>" enctype="multipart/form-data">
                                                     <?php echo csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span >&times;</span></button>
                                                        <h4 class="modal-title">Delete Item</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> Do you really want to delete this Item?</p>
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
                            <span class="glyphicon glyphicon-plus pull-right"></span>
                        </a>

                        <div class="modal fade" id="add" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                        <form method="post" action="<?php echo e(route('item.store')); ?>" enctype="multipart/form-data">
                                             <?php echo csrf_field(); ?>
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span >&times;</span></button>
                                                <h4 class="modal-title">Create New Menu Item</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Item Name</label>
                                                    <input type="text" class="form-control" name="item_name" required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Item Description</label>
                                                        <input type="text" class="form-control" name="item_desc" required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Item Price</label>
                                                        <input type="text" class="form-control" name="item_price" required>
                                                </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-flat pull-right">Save</button>
                                            </div>
                                        </form>
                                 </div>
                               </div>
                            </div>
                            

                     </div>
                 </div>
    </section>

<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/menu manager/display_items.blade.php ENDPATH**/ ?>