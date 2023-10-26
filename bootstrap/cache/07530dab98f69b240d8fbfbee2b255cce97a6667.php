<?php $__env->startSection('title', 'Product Index Page'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <?php echo $__env->make('layout.admin_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-8">
                <h1>Product Index</h1>
                <?php if(App\Classes\Session::has("product_insert_success")): ?>
                    <?php App\Classes\Session::flash("product_insert_success") ?>
                <?php endif; ?>
                
                    <table class="table table-bordered text-center">
                        <thead>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="text-muted">
                                    <td><?php echo e($product->id); ?></td>
                                    <td>
                                        <img src="<?php echo e($product->image); ?>" alt="" style="max-width:50px; max-height: 100px;">
                                    </td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td><?php echo e($product->price); ?></td>
                                    <td>
                                        <i class="fa fa-edit text-warning mx-2"></i>
                                        <i class="fa fa-trash text-danger"></i>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>