<?php $__env->startSection('content'); ?>

<section class="content-header text-center"><h3>MENUS</h3>
 
</section>
    <section class="content-header">
    <div>
      <form method="post" action="filter_menu" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="Menu_Date">Menu Date: </label>
                <div class="input-group date col-md-4">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" id="datepicker" name="Menu_Date" required>
                  </div>
              

          </div>
          <div>
         
          <button type="submit" class="btn btn-default">Filter</button>
          </div>
          
           </form>
           <button type="button" class="btn btn-default " ><a href="<?php echo e(URL::to('menu')); ?>">Reset</a></button>
    </div>
    <a  target="_blank" href="<?php echo e(url('Mhelp/ViewingMenus.html')); ?>" class="pull-right" title="Get Help">
      <span class="glyphicon glyphicon-question-sign"></span>
  </a> 
    </section>
    <section class="content">
        <?php for($i=0;$i<count($cat);$i++): ?>
        <div class="box">
            <div class="box-header with-border text-center">
                <h3 class="box-title"><?php echo e($cat[$i]->Category_Name); ?></h3>
                
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id ="example1">
                    <tr>
                        <td> Date </td>
                        <td> Dishes </td>
                        <td> Dish Description </td>
                        <td> Price </td>
                        <td> Action </td>
                    </tr> 
                    
                    <?php for($j=0;$j<count($val[$i]);$j++): ?> 
                    <tr>  
                        <td><?php echo e($menu[$i][$j]->Menu_Date); ?></td>
                        <td> 
                            <?php for($k=0;$k<count($val[$i][$j]);$k++): ?>
                             <div><?php echo e($val[$i][$j][$k]->Food_Name); ?></div>
                             <?php endfor; ?>
                        </td>
                        <td> 
                            <?php for($k=0;$k<count($val[$i][$j]);$k++): ?>
                            <div><?php echo e($val[$i][$j][$k]->Food_Desc); ?></div>
                             <?php endfor; ?>
                        </td>
                        <td> 
                             <?php for($k=0;$k<count($val[$i][$j]);$k++): ?>
                             <div><?php echo e($val[$i][$j][$k]->Price); ?></div>
                             <?php endfor; ?>
                         </td>
                         
                        <td>
                                <a data-toggle="modal" data-target="#<?php echo e($menu[$i][$j]->Menu_ID); ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                </a> 
                                <a data-toggle="modal" data-target="#delete<?php echo e($menu[$i][$j]->Menu_ID); ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                </a>

                                
                                 
                                 
                        </td>  

                           <div class="modal fade" id="<?php echo e($menu[$i][$j]->Menu_ID); ?>" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form method="post" action="<?php echo e(route('menu.update', $menu[$i][$j]->Menu_ID)); ?>" enctype="multipart/form-data">
                                        <?php echo method_field('PATCH'); ?> 
                                         <?php echo csrf_field(); ?>
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span >&times;</span></button>
                                  <h4 class="modal-title">Edit </h4>
                                </div>
                                
                                <div class="modal-body" >
                                          <div class="form-group">
                                            <label for="Menu_Date">Menu Date:</label>
                                                  <div class="input-group date">
                                                    <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="date" class="form-control pull-right" id="datepicker" name="Menu_Date" value=<?php echo e($menu[$i][$j]->Menu_Date); ?> required>
                                                    </div>

                                            </div>
                                            
                                            <label>Menu Items</label>
                                            <?php for($n=0;$n<count($rest);$n++): ?>
                                                <div class="checkbox" >
                                                  <label><input  
                                                       type="checkbox"  value="<?php echo e($rest[$n]->Menu_Food_Item_ID); ?>"  name="Food[]" 
                                                       <?php for($k=0;$k<count($val[$i][$j]);$k++): ?>
                                                      <?php if(($val[$i][$j][$k]->Menu_Food_Item_ID)==($rest[$n]->Menu_Food_Item_ID)): ?>  ? checked : 
                                                      <?php endif; ?> <?php endfor; ?>><?php echo e($rest[$n]->Food_Name); ?></label>
                                                </div> 
                                            
                                            <?php endfor; ?> 
                                            

                                          </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success btn-flat pull-right">Save changes</button>
                                      </div>
                                      </form>
                                    </div>
                                 </div>
                             </div>

                             <div class="modal fade" id="delete<?php echo e($menu[$i][$j]->Menu_ID); ?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <form method="post" action="<?php echo e(route('menu.destroy', $menu[$i][$j]->Menu_ID)); ?>" enctype="multipart/form-data">
                                         <?php echo csrf_field(); ?>
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span >&times;</span></button>
                                        <h4 class="modal-title">Delete</h4>
                                      </div>
                                      
                                      <div class="modal-body">
                                        <p>Do you sure that you want to delete this menu?</p>  
                                        <input name="_method" type="hidden" value="DELETE">     
                                      </div>
                                      <div class="modal-footer">
                                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">NO</button>
                                              <button type="submit" class="btn btn-success btn-flat pull-right">YES</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                            </tr>
                   <?php endfor; ?> 
                </table>
            </div>
           
            <div>
                <a data-toggle="modal" data-target="#<?php echo e($cat[$i]->Category_Name); ?>">
                  <span class="glyphicon glyphicon-plus pull-right"></span>
                </a>
            </div>

            <div class="modal fade" id="<?php echo e($cat[$i]->Category_Name); ?>" data-backdrop="static" data-keyboard="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="post" action="<?php echo e(route('category.store')); ?>" enctype="multipart/form-data">
                     <?php echo csrf_field(); ?>
                     <input class="hidden" name="Category" value="<?php echo e($cat[$i]->Category_ID); ?>">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span >&times;</span></button>
                    <h3 class="modal-title" >Add Menu </h3>
                    
                  </div>
                  
                  <div class="modal-body" >
                            <div class="form-group">
                              <label for="Menu_Date">Menu Date:</label>
                                <div class="input-group date">
                                 <div class="input-group-addon">
                                     <i class="fa fa-calendar"></i>
                                  </div>
                                    <input type="date" min="<?php echo e(date('mm-dd-yyyy')); ?>" class="form-control pull-right" id="datepicker" name="Menu_Date" required >
                                </div>
                              <label>Menu Items</label>
                             <?php for($j=0;$j<count($rest);$j++): ?>
                                  <div class="checkbox">
                                  <label>
                                    <input type="checkbox" value="<?php echo e($rest[$j]->Menu_Food_Item_ID); ?>"  name="Food[]">
                                    <?php echo e($rest[$j]->Food_Name); ?>

                                  </label>
                                  </div>
                            <?php endfor; ?> 
                            
                            </div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success btn-flat pull-right">Add New Menu</button>
                        </div>
                        </form>
                        
                       
                      </div>
                   </div>
               </div>


        </div>
    </div>
    
<?php endfor; ?>
</section>
 
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/menu manager/display_menu.blade.php ENDPATH**/ ?>