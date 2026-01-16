<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        

        <?php $__env->startSection('content'); ?>

                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Pizza House<br/>
                       </h2>

                                <div class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                   <h1 class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Order from <?php echo e($pizza->name); ?></h1>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Type - <?php echo e($pizza->type); ?></p>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Base - <?php echo e($pizza->base); ?></p>
                                    <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">Extra toppings:</p>
                                <ul class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">

                                    <?php $__currentLoopData = $pizza->toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <li class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"><?php echo e($topping); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </ul>
                                <form action="/pizzas/<?php echo e($pizza->id); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button>Complete Order</button>
                                </form>
                                </div>
                              
                                  <a href="/pizzas" class="back"><- Back to all pizzas </a>
                            </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MyDoc\pizzahouse\resources\views/pizzas/show.blade.php ENDPATH**/ ?>