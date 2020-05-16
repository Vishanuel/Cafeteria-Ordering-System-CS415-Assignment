<?php $__env->startSection('content'); ?>
<section class="content-header text-center"></section>
<section class="content">
    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">Custom Meal</h3>
        </div>

        <div class="box-body ">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive" src="../dist/img/restaurant/login22.jpg" />
                </div>
                <div class=" form-group col-sm-6 ">
                    <div class="row">
                        <h4>Select Your Menu Item</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <select id="menus" name="menu" class="form-control">
                                    <option value=""></option>
                                    <?php for($j=0;$j<count($items);$j++): ?> <option value="<?php echo e($items[$j]->Menu_Food_Item_ID); ?>">
                                        <?php echo e($items[$j]->Food_Name); ?></option>
                                        <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <?php for($k=0;$k<count($items);$k++): ?> <div class="items" id="item<?php echo e($k); ?>" style="display:none;">
                                <?php if(count($ingredients[$k])>0): ?>
                                <h4>Ingredients</h4>
                                <?php for($j=0;$j<count($ingredients[$k]);$j++): ?> <div class="checkbox">
                                    <input value="<?php echo e($ingredients[$k][$j]->Ingredient_ID); ?>" type="checkbox"
                                        class="minimal" />
                                    <label><?php echo e($ingredients[$k][$j]->Ingredient_Name); ?></label>
                        </div>
                        <?php endfor; ?>
                        <?php endif; ?>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer with-border">
        <a class=" btn btn-info btn-flat pull-right" type="button" href="#">
            Order Your Meal
        </a>
    </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\COS\resources\views/patron/custommeal.blade.php ENDPATH**/ ?>