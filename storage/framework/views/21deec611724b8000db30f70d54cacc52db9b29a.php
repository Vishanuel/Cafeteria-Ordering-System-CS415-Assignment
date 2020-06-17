<?php $__env->startSection('content'); ?>
<section class="content-header text-center">
    
</section>
    <section class="content">
            <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Menu Ingredients</h3>
                        <a  target="_blank" href="<?php echo e(url('Mhelp/ViewingIngredients.html')); ?>" class="pull-right" title="Get Help">
                            <span class="glyphicon glyphicon-question-sign"></span>
                        </a>
                    </div>

                    <div class="box-body ">
                    <table class="table table-bordered table-striped text-center" id ="example1">
                    <tr>
                        <th>Ingredient Name</th>
                        <th>Ingredient Price</th>
                        <th>Ingredient Quantity</th>
                        <th>Ingredient Type</th>
                        <th>Action</th>
                    </tr>
                        <?php for($i=0;$i<count($ingredients);$i++): ?>
                        <tr>
                           
                            <td >
                                <?php echo e($ingredients[$i]->Ingredient_Name); ?>

                            </td>
                            <td >
                                <?php echo e($ingredients[$i]->Ingredient_Price); ?>

                            </td>
                            <td >
                                <?php echo e($ingredients[$i]->Ingredient_Quantity); ?>

                            </td>
                            <td >
                                <?php echo e($ingredients[$i]->Ingredient_Type_Name); ?>

                            </td>
                           
                            <td >
                                <a data-toggle="modal" data-target="#<?php echo e($ingredients[$i]->Ingredient_ID); ?>">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete<?php echo e($ingredients[$i]->Ingredient_ID); ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>

                                <div class="modal fade" id="<?php echo e($ingredients[$i]->Ingredient_ID); ?>" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                            <form method="post" action="<?php echo e(route('ingredient.update', $ingredients[$i]->Ingredient_ID)); ?>" enctype="multipart/form-data">
                                                <?php echo method_field('PATCH'); ?> 
                                                 <?php echo csrf_field(); ?>
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span >&times;</span></button>
                                                    <h4 class="modal-title">Edit Ingredient</h4>
                                                </div>
                                                <div class="modal-body">
                                                   
                                                    <div class="form-group">
                                                        <label>Ingredient Name</label>
                                                        <input type="text" class="form-control" name="ingredient_name" value="<?php echo e($ingredients[$i]->Ingredient_Name); ?>" required>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Ingredient Price</label>
                                                    <input type="number" class="form-control" name="ingredient_price" min="0" value="<?php echo e($ingredients[$i]->Ingredient_Price); ?>" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ingredient Quantity</label>
                                                    <input type="number" class="form-control" name="ingredient_quantity" min="0" value="<?php echo e($ingredients[$i]->Ingredient_Quantity); ?>" required>
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
                                
                                <div class="modal fade" id="delete<?php echo e($ingredients[$i]->Ingredient_ID); ?>" >
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                                <form method="post" action="<?php echo e(route('ingredient.destroy',$ingredients[$i]->Ingredient_ID)); ?>" enctype="multipart/form-data">
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
                                                        <label>Ingredient Name</label>
                                                        <input type="text" class="form-control" name="ingredient_name" required>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Ingredient Price</label>
                                                    <input type="number" class="form-control" name="ingredient_price" min="0" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ingredient Quantity</label>
                                                    <input type="number" class="form-control" name="ingredient_quantity" min="0" required>
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