<?php
if ( isset( $_SESSION['user'] ) ) {
    header( 'location: /dashboard' );
    exit;
}
?>
<main class="">
    <div class="relative flex flex-col justify-center min-h-screen py-6 overflow-hidden bg-gray-50 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 max-w-none" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        <div class="relative px-6 pt-10 pb-8 bg-white shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="max-w-md mx-auto text-center px-">
                <h1 class="inline-block text-3xl font-bold text-transparent bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 bg-clip-text">TruthWhisper</h1>
                <div class="divide-y divide-gray-300/50">
                    <div class="px-12 py-8 space-y-6 text-base leading-7 text-gray-600">
                        <h2>A better way to get anonymous feedback!</h2>
                        <div class="flex justify-center">
                            <img class="max-h-72" src="./images/letter.png" alt="">
                        </div>
                    </div>
                    <div class="pt-8 text-base font-semibold leading-7">
                        <p class="text-gray-900">Sounds interesting?</p>
                        <p>
                            <a href="./login" class="text-sky-500 hover:text-sky-600">Let's start!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
