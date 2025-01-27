<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="/css/faq.css">
<div class="section">
    <div class="faq-component">
        <div class="faq-head">
            <h1 class="faq-caption">Answers to questions</h1>
            <?php if($settings->vk_support_link): ?>
            <div class="faq-link"><a class="btn btn-light" href="<?php echo e($settings->vk_support_link); ?>" target="_blank">Write to support</a></div>
            <?php endif; ?>
        </div>
        <div class="faq-item">
            <div class="caption">
                <div class="caption-block">
                    <svg class="icon icon-faq">
                        <use xlink:href="/img/symbols.svg#icon-faq"></use>
                    </svg> About Us.
                </div>
            </div>
            <div class="faq-content">
                <p><?php echo e($settings->sitename); ?> - these are exciting and provable fair mini-games.</p>
                <p>Play games and win coins that you can exchange for real money.</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="caption">
                <div class="caption-block">
                    <svg class="icon icon-coin">
                        <use xlink:href="/img/symbols.svg#icon-coin"></use>
                    </svg> Coins
                </div>
            </div>
            <div class="faq-content">
                <p>Coins are our in-game currency. Rate: 1.00 coins = 1.00 €</p>
                <p>You can buy coins on the page <a class="" data-toggle="modal" data-target="#walletModal">coin purchases</a> or get free up to 5.00 coins every 120 minutes on the page <a class="" href="/free">free coins</a></p>
            </div>
        </div>
        <div class="faq-item">
            <div class="caption">
                <div class="caption-block">
                    <svg class="icon icon-fairness">
                        <use xlink:href="/img/symbols.svg#icon-fairness"></use>
                    </svg> Provably Fair
                </div>
            </div>
            <div class="faq-content">
                <p>A random number generator creates provable and completely fair random numbers that are used to determine the result of every game played on the site.</p>
                <p>Each user can check the outcome of any game in a completely deterministic way. By providing one parameter, the client hash, to the inputs of the random number generator, <?php echo e($settings->sitename); ?> cannot manipulate the results in its favour.</p>
                <p>The <?php echo e($settings->sitename); ?> random number generator allows each game to request any number of random numbers from a given client starting number, server starting number, and one-time number.</p>
            </div>
        </div>
        <div class="faq-item">
            <div class="caption">
                <div class="caption-block">
                    <svg class="icon icon-affiliate">
                        <use xlink:href="/img/symbols.svg#icon-affiliate"></use>
                    </svg> Affiliate Programme
                </div>
            </div>
            <div class="faq-content">
                <p>Invite other players to our site <a class="" href="/affiliate">through your referral link</a> and earn 3% of our profit from every bet made by your referral.</p>
            </div>
        </div>

        <div class="faq-item">
            <div class="caption">
                <div class="caption-block">
                    <svg class="icon icon-tasks">
                        <use xlink:href="/img/symbols.svg#icon-tasks"></use>
                    </svg> Conclusion
                </div>
            </div>
            <div class="faq-content">
            <p>Withdrawal is processed within two working days.</p>
            <p>So far five payment systems are available and their number will increase over time.</p>
            <p>Minimum deposit to the site 10 rubles, the minimum withdrawal depends on the payment system, but not less than 100 rubles.</p>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /* /var/www/html/resources/views/pages/faq.blade.php */ ?>