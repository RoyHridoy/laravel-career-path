<main class="">
    <div class="relative flex flex-col justify-center min-h-screen py-6 overflow-hidden bg-gray-50 sm:py-12">
        <img src="../images/beams.jpg" alt="" class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 max-w-none" width="1308" />
        <div class="absolute inset-0 bg-[url(../images/grid.svg)] bg-center [mask-image:linear-gradient(180deg,white,rgba(255,255,255,0))]"></div>
        <div class="relative px-6 pt-10 pb-8 bg-white shadow-xl ring-1 ring-gray-900/5 sm:mx-auto sm:max-w-lg sm:rounded-lg sm:px-10">
            <div class="max-w-md mx-auto text-center px-">
                <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-16 lg:px-6">
                    <div class="max-w-screen-sm mx-auto text-center">
                        <p class="mb-4 text-lg font-semibold text-gray-500"><?php if ( isset( $info ) ) {echo $info;}?></p>
                        <a href="/" class="inline-flex text-black bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Back to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
