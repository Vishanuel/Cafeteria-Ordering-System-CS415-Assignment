<?php $__env->startSection('content'); ?>
<section class="content-header text-center"></section>
    <section class="content">
            <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Menu Ingredients</h3>
                    </div>

                    <div class="box-body ">
                    <table class="table table-bordered table-striped text-center" id ="example1">
                    <tr>
                        <th>Menu Item</th>
                        <th>Ingredient Name</th>
                        <th>Ingredient Type</th>
                        <th>Action</th>
                    </tr>
                        <?php for($i=0;$i<count($ingredients);$i++): ?>
                        <tr>
                            <td >
                                <?php echo e($ingredients[$i]->Food_Name); ?>

                            </td>
                            <td >
                                <?php echo e($ingredients[$i]->Ingredient_Name); ?>

                            </td>
                            <td >
                                <?php echo e($ingredients[$i]->Ingredient_Type_Name); ?>

                            </td>
                           
                            <td >
                                <a data-toggle="modal" data-target="#<?php echo e($ingredients[$i]->Item_Ingredient_ID); ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete<?php echo e($ingredients[$i]->Item_Ingredient_ID); ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                                <div class="modal fade" id="<?php echo e($ingredients[$i]->Item_Ingredient_ID); ?>" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <form method="post" action="<?php echo e(route('ingredient.update', $ingredients[$i]->Item_Ingredient_ID)); ?>" enctype="multipart/form-data">
                                                <?php echo method_field('PATCH'); ?> 
                                                 <?php echo csrf_field(); ?>
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span >&times;</span></button>
                                                    <h4 class="modal-title">Edit Ingredient</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="menus">Menu Item Name</label>
                                                        
                                                        <select id="menus" name="menu_item" class="form-control">
                                                            <?php for($j=0;$j<count($menu);$j++): ?>
                                                            <option value=<?php echo e($menu[$j]->Menu_Food_Item_ID); ?> <?php if($menu[$j]->Menu_Food_Item_ID == $ingredients[$i]->Item_ID): ?> selected="selected"<?php endif; ?>><?php echo e($menu[$j]->Food_Name); ?></option>
                                                            <?php endfor; ?>
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ingredient Name</label>
                                                        <input type="text" class="form-control" name="ingredient_name"value="<?php echo e($ingredients[$i]->Ingredient_Name); ?>" required>
                                                  </div>
                                                 
                                                        <?php for($k=0;$k<count($type);$k++): ?>
                                                        <div>
                                                        <input type="radio" name="type"value="<?php echo e($type[$k]->Ingredient_Type_ID); ?>"
                                                        <?php if(($ingredients[$i]->Ingredient_Type_ID)==($type[$k]->Ingredient_Type_ID)): ?>  ? checked : <?php endif; ?>>
                                                        <label for="type"><?php echo e($type[$k]->Ingredient_Type_Name); ?></label>
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
                                
                                <div class="modal fade" id="delete<?php echo e($ingredients[$i]->Item_Ingredient_ID); ?>" >
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                                <form method="post" action="<?php echo e(route('ingredient.destroy',$ingredients[$i]->Item_Ingredient_ID)); ?>" enctype="multipart/form-data">
                                                     <?php echo csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span >&times;</span></button>
                                                        <h4 class="modal-title">Delete Ingredient</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> Do you really want to delete this Ingredient?</p>
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
                                        <form method="post" action="<?php echo e(route('ingredient.store')); ?>" enctype="multipart/form-data">
                                             <?php echo csrf_field(); ?>
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span >&times;</span></button>
                                                <h4 class="modal-title">Create New Ingredient</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="menus">Menu Item </label>
                                                        
                                                        <select id="menus" name="menu_item" class="form-control">
                                                            <option value=""></option>
                                                            <?php for($j=0;$j<count($menu);$j++): ?>
                                                            <option value="<?php echo e($menu[$j]->Menu_Food_Item_ID); ?>"><?php echo e($menu[$j]->Food_Name); ?></option>
                                                            <?php endfor; ?>
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ingredient Name</label>
                                                        <input type="text" class="form-control" name="ingredient_name" required>
                                                  </div>
                                                 
                                                        <?php for($k=0;$k<count($type);$k++): ?>
                                                        <div>
                                                        <input type="radio" name="type"value="<?php echo e($type[$k]->Ingredient_Type_ID); ?>">
                                                        <label for="type"><?php echo e($type[$k]->Ingredient_Type_Name); ?></label>
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
                            

                     </div>
                 </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/menu manager/display_ingredients.blade.php ENDPATH**/ ?>