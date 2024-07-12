
<main class="">
    <div class="relative flex flex-col justify-center min-h-screen py-6 overflow-hidden bg-gray-50 sm:py-12">
        <img src="./images/beams.jpg" alt="" class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 max-w-none" width="1308" />
        <div class="absolute inset-0 bg-[url(./images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        <div class="relative px-6 pt-10 pb-8 bg-white shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="max-w-xl mx-auto">
                <div class="flex flex-col justify-center min-h-full px-6 py-12 lg:px-8">
                    <div class="w-full max-w-xl mx-auto text-center">
                        <h1 class="inline-block text-2xl font-bold text-center text-transparent bg-gradient-to-r from-blue-600 via-green-500 to-indigo-400 bg-clip-text">TruthWhisper</h1>
                        <h3 class="my-2 text-gray-500">Want to ask something or share a feedback to
                            <span class="font-semibold"><?php echo $name; ?></span>
                        ?</h3>
                        <?php echo $uniqueId;    ?>
                    </div>

                    <div class="w-full max-w-xl mx-auto mt-10">
                        <form class="space-y-6" action="#" method="POST">
                            <div>
                                <label for="feedback" class="block text-sm font-medium leading-6 text-gray-900">Don't hesitate, just do it!</label>
                                <div class="mt-2">
                                    <textarea required name="feedback" id="feedback" cols="30" rows="10" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>