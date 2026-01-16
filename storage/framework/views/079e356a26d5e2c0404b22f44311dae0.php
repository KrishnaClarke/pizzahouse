<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        

        <?php $__env->startSection('content'); ?>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Pizza House<br/>
                         Pizzas Menu</h2>

                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                   
                                
                                 


                                  <?php $__currentLoopData = $pizzas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pizza): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">

                                    <a href="/pizzas/<?php echo e($pizza->id); ?>"><?php echo e($pizza->name); ?></a>
                                 
                                    </div>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                              
                                  
                            </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MyDoc\pizzahouse\resources\views/pizzas/index.blade.php ENDPATH**/ ?>