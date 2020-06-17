<?php $__env->startSection('content'); ?>
<section class="content-header text-center">
    
</section>
    <section class="content">
            <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title">Menu Items</h3>
                        <a  target="_blank" href="<?php echo e(url('Mhelp/ViewingMenuItems.html')); ?>" class="pull-right" title="Get Help">
                            <span class="glyphicon glyphicon-question-sign"></span>
                        </a>
                    </div>

                    <div class="box-body ">
                    <table class="table table-bordered table-striped text-center" id ="example1">
                    <tr>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Default Ingredients</th>
                        <th>Other Ingredients</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Deliverability</th>
                        <th>Action</th>
                    </tr>
                        <?php for($i=0;$i<count($dish);$i++): ?>
                        <tr>
                            <td title=" Name of the Item">
                                <?php echo e($dish[$i]->Food_Name); ?>

                            </td>
                            <td><div class="widget-user-header bg-black"
                                style="height:90px; background: url('../<?php echo e($dish[$i]->Food_Pic); ?>') center center;background-repeat: no-repeat;  background-size: cover;">
                            </div>
                                </td>
                            <td title=" default ingredients that goes with the item">
                                <?php for($j=0;$j<count($ingredient[$i]);$j++): ?>
                                <div><?php echo e($ingredient[$i][$j]->Ingredient_Name); ?></div>
                                <?php endfor; ?>
                            </td>
                            <td title="ingredients that is used for customization">
                                <?php for($j=0;$j<count($other_ingredient[$i]);$j++): ?>
                                <div><?php echo e($other_ingredient[$i][$j]->Ingredient_Name); ?></div>
                                <?php endfor; ?>
                            </td>
                            <td title=" Description of the Item">
                                <?php echo e($dish[$i]->Food_Desc); ?>

                            </td>
                            <td title=" Price of the Item">
                                <?php echo e($dish[$i]->Price); ?>

                            </td>
                            <td title=" Quantity of the Item">
                                <?php echo e($dish[$i]->Quantity); ?>

                            </td>
                             <td>
                           <?php if($dish[$i]->Deliverable==0): ?>
                              Not Deliverable <?php else: ?> Deliverable <?php endif; ?>
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
                                                        <input type="text" class="form-control" name="item_name" title="Name of the Item" value="<?php echo e($dish[$i]->Food_Name); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Item Description</label>
                                                        <input type="text" class="form-control" name="item_desc" title="Description of the Item" value="<?php echo e($dish[$i]->Food_Desc); ?>" required>
                                                  </div>
                                                  <div class="form-group">
                                                          <label>Item Price</label>
                                                          <input type="number" class="form-control" name="item_price" title="Price of the Item" value="<?php echo e($dish[$i]->Price); ?>" min="0" placeholder="0.00" required>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input type="number" class="form-control" name="item_quantity" title="Quantity of the Item" value="<?php echo e($dish[$i]->Quantity); ?>" min="0"  placeholder="0" required>
                                                 </div>
                                                  <label>Is this Menu Deliverable? </label>
                                            <div class="radio">
                                              <label><input type="radio" id="deliverable" name="deliverable" value="1" 
                                                <?php if(($dish[$i]->Deliverable)==1): ?>  ? checked : 
                                                <?php endif; ?>>Deliverable</label>
                                              <label><input type="radio" id="mon-deliverable" name="deliverable" value="0" 
                                                <?php if(($dish[$i]->Deliverable)==0): ?>  ? checked : 
                                                <?php endif; ?>>Non-Deliverable</label>
                                           
                                            </div>
                                                  <div class="row form-group checkbox">
                                                        <div class="col-md-6">
                                                                <label title="Ingredient that default with the Item"><b>Default Ingredients</b></label>
                                                                <?php for($k=0;$k<count($all_ingredient);$k++): ?>
                                                                <div> <label>
                                                                        <input type="checkbox"  name="default[]" value="<?php echo e($all_ingredient[$k]->Ingredient_ID); ?>" <?php for($j=0;$j<count($ingredient[$i]);$j++): ?>
                                                                        <?php if($all_ingredient[$k]->Ingredient_ID==$ingredient[$i][$j]->Ingredient_ID): ?>
                                                                        ? checked : 
                                                                        <?php endif; ?>
                                                                        <?php endfor; ?>>
                                                                        <?php echo e($all_ingredient[$k]->Ingredient_Name); ?>

                                                                    </label></div>
                                                                <?php endfor; ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <label title="other Ingredients of Item used for meal customization "><b>Other Ingredients</b></label>
                                                                <?php for($k=0;$k<count($all_ingredient);$k++): ?>
                                                                <div> <label>
                                                                        <input type="checkbox"  name="other[]" value="<?php echo e($all_ingredient[$k]->Ingredient_ID); ?>" <?php for($j=0;$j<count($other_ingredient[$i]);$j++): ?>
                                                                        <?php if($all_ingredient[$k]->Ingredient_ID==$other_ingredient[$i][$j]->Ingredient_ID): ?>
                                                                        ? checked : 
                                                                        <?php endif; ?>
                                                                        <?php endfor; ?>>
                                                                        <?php echo e($all_ingredient[$k]->Ingredient_Name); ?>

                                                                    </label></div>
                                                                <?php endfor; ?>
                                                        </div>
                                                    </div>
                                                    <div> 
                                                        <label for="exampleInputFile">File input</label>
                                                        <input type="file" id="exampleInputFile" name="image">
                                                        <div class="widget-user-header bg-black"
                                                            style="height:90px; background: url('../<?php echo e($dish[$i]->Food_Pic); ?>') center center;background-repeat: no-repeat;  background-size: cover;">
                                                        </div>
                                                        <p class="help-block">Select Image of your Menu Item</p>
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
                                                    <input type="text" class="form-control" name="item_name" title="Name of the Item" required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Item Description</label>
                                                        <input type="text" class="form-control" name="item_desc" title="Description of the Item" required>
                                                </div>
                                                <div class="form-group">
                                                        <label>Item Price</label>
                                                        <input type="number" class="form-control" name="item_price" title="Price of the Item" min="0.00" placeholder="0.00" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Item Quantity</label>
                                                    <input type="number" class="form-control" name="item_quantity" title="Quantity of the Item" min="0"  placeholder="0" required>
                                                 </div>
                                                 <label>Is this Menu Deliverable? </label>
                                                    <div class="radio">
                                                    <label><input type="radio" id="deliverable" name="deliverable" value="1">Deliverable</label>
                                                    <label><input type="radio" id="mon-deliverable" name="deliverable" value="0">Non-Deliverable</label>
                                                                
                                                    </div>
                                                <div class="row form-group checkbox">
                                                    <div class="col-md-6">
                                                            <label title="Ingredient that default with the Item"><b>Default Ingredients</b></label>
                                                            <?php for($k=0;$k<count($all_ingredient);$k++): ?>
                                                            <div> <label>
                                                                    <input type="checkbox"  name="default[]" value="<?php echo e($all_ingredient[$k]->Ingredient_ID); ?>">
                                                                    <?php echo e($all_ingredient[$k]->Ingredient_Name); ?>

                                                                </label></div>
                                                            <?php endfor; ?>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <label title="other Ingredients of Item used for meal customization "><b>Other Ingredients</b></label>
                                                            <?php for($k=0;$k<count($all_ingredient);$k++): ?>
                                                            <div> <label>
                                                                    <input type="checkbox"  name="other[]" value="<?php echo e($all_ingredient[$k]->Ingredient_ID); ?>">
                                                                    <?php echo e($all_ingredient[$k]->Ingredient_Name); ?>

                                                                </label></div>
                                                            <?php endfor; ?>
                                                    </div>
                                                </div>
                                                <div> 
                                                    <label for="exampleInputFile">File input</label>
                                                    <input type="file" id="exampleInputFile" name="image">
                                                    <p class="help-block">Select Image of your Menu Item</p>
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