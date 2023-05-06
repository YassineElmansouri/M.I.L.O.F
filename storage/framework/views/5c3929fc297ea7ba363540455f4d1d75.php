

<?php $__env->startSection('content'); ?>

<div class="container text-white">
    <div class="row movie-info">
        <div class="col-md-4">
            <img class="movie-poster the-img" src="<?php echo e(asset('uploads/entertainments/'.$info->img)); ?>"
                alt="<?php echo e($info->name); ?> poster">
        </div>
        <div class="col-md-8">
            <h1><?php echo e($info->name); ?></h1>
            <div class="movie-rating">
                <h3 class="average-rating"><img class='rating-star' width="30"
                        src="<?php echo e(asset('uploads/entertainments/star.png')); ?>" alt="star"><?php echo e($averageRating); ?> / 5 </h3>
                <h5><img class='user-icon' width="20" src="<?php echo e(asset('uploads/entertainments/user.png')); ?>"
                        alt="user"><?php echo e($users); ?> user ratings</h5>
            </div>
            <div class="movie-actions">
                <form action="<?php echo e(route('rating')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="rating">Rate this movie:</label>
                        <div class="rating">
                            <input type="radio" id="star5" name="rate" value="5" /><label for="star5"
                                title="5 stars"></label>
                            <input type="radio" id="star4" name="rate" value="4" /><label for="star4"
                                title="4 stars"></label>
                            <input type="radio" id="star3" name="rate" value="3" /><label for="star3"
                                title="3 stars"></label>
                            <input type="radio" id="star2" name="rate" value="2" /><label for="star2"
                                title="2 stars"></label>
                            <input type="radio" id="star1" name="rate" value="1" /><label for="star1"
                                title="1 star"></label>
                        </div>
                    </div>
                    <?php if(auth()->check()): ?>
                    <input type="hidden" name="entertainment_id" value="<?php echo e($info->id); ?>" />
                    <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>" />
                    <input type="submit" value="Rate" class="btn btn-primary">
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">Login</a>
                    <?php endif; ?>

                </form>
            </div>

        </div>
    </div>
    <div class="row comments my-5">
        <div class="comments">
            <form action="<?php echo e(route('comment')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill shadow-sm px-4 comment-field" required name="comment" placeholder="Type your comment..." maxlength="250">
                </div>
                <?php if(auth()->check()): ?>
                <input type="hidden" name="entertainment_id" value="<?php echo e($info->id); ?>" />
                <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>" />
                <input type="hidden" name="user_name" value="<?php echo e(Auth::user()->name); ?>">

                <button type="submit" class="my-3 btn btn-primary rounded-pill px-5 py-2">Comment</button>

                <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"  class="my-3 btn btn-primary rounded-pill px-5 py-2">Login</a>
                <?php endif; ?>
            </form>
        </div>
        <div>

            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="comment">
                <table class="comment-section border-rounded my-3">
                    <tr>
                        <td rowspan="2" class="p-2"><img class='user-icon' width="50" src="<?php echo e(asset('uploads/entertainments/utilisateur.png')); ?>"alt="user"></td>
                        <td><?php echo e($comment->user_name); ?></td>
                        <tr>
                            <td ><?php echo e($comment->created_at); ?></td>
                        </tr>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-2" width="500"><?php echo e($comment->comment); ?></td>
                    </tr>
                    
                </table>
            <?php if(auth()->check() && Auth::user()->name == $comment->user_name): ?>
                <form action="<?php echo e(route('delete_comment', $comment->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="my-3 btn btn-danger rounded-pill px-5 py-2">Delete Comment</button>
                </form>
            <?php endif; ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\M.I.L.O.F\resources\views/pages/info.blade.php ENDPATH**/ ?>