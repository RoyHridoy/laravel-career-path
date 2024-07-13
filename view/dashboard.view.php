<main class="">
    <div class="relative flex min-h-screen py-6 overflow-hidden bg-gray-50 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 max-w-none" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>

        <div class="relative mx-auto max-w-7xl">
            <div class="flex justify-end">
                <div class="flex flex-col">
                    <h3 class="mb-2 ml-1 font-semibold text-gray-700">Hey, <?php print_r($name); ?></h3>
                    <span class="block px-2 py-1 font-mono text-gray-600 border border-gray-400 rounded-xl">Your feedback form link: <strong>http://localhost/feedback/<?php echo $uniqueId ?></strong></span>
                </div>
            </div>
            <h1 class="my-10 text-xl text-indigo-800 text-bold">Received feedback</h1>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <?php foreach ($messages as $message) : ?>
                    <div class="relative flex items-center px-6 py-5 space-x-3 bg-white border border-gray-300 rounded-lg shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
                        <div class="focus:outline-none">
                            <p class="text-gray-500"><?php print $message["feedback"]; ?></p>
                        </div>
                    </div>
               <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>