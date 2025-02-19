<div class="flex w-full h-full flex-col ">
    <div class="flex w-full gap-x-4  items-center"><button
            class="flex items-center text-sm sm:text-xl border-c1 border-2 rounded-full  w-fit max-w-64 text-c1 font-semibold my-3 px-4">
            <span class="iconify text-c1 sm:size-8 size-4 sm:mr-2 font-semibold" data-icon="ion:add"
                data-inline="false"></span>
            AJOUTER
        </button>
        <select name="lieuxActivite" id="lieuxActivite"
            class="lg:w-1/4 w-1/2 h-1/2 rounded-full border-2  border-c1 "></select>
        <select name="typeActivite" id="typeActivite"
            class=" lg:w-1/4 w-1/2 rounded-full border-2    border-c1  h-1/2 "></select>
    </div>
    <div class="grid grid-col-1 md:grid-cols-2 xl:grid-cols-3 gap-4 w-full  mt-2 mb-2">

        <div class="w-full h-96 flex bg-c3 transition shadow-lg rounded-md cursor-pointer relative overflow-hidden scale-90 ease-in-out duration-300 border hover:border-2 hover:scale-100 hover:border-c1"
            x-data="{
                current: 0,
                images: ['{{ asset('/Images/Logos/logoC1.svg') }}', '{{ asset('/Images/Logos/logoC2.svg') }}'],
                interval: null,
                next() {
                    this.current = this.current < this.images.length - 1 ? this.current + 1 : 0;
                },
                startCarousel() {
                    this.interval = setInterval(() => { this.next(); }, 3000);
                },
                stopCarousel() {
                    clearInterval(this.interval);
                }
            }" x-on:mouseenter="startCarousel()" x-on:mouseleave="stopCarousel()">

            <!-- Carousel Images -->
            <template x-for="(img, index) in images" :key="index">
                <img x-show="current === index" :src="img" alt="Logo"
                    class="w-full h-96 object-cover absolute inset-0 transition duration-300 ease-in-out"
                    x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0 scale-90"
                    x-transition:enter-end="opacity-100 scale-100" />
            </template>
            <div class="w-full flex justify-center items-end"> <span class=" bg-c1 opacity-75 flex h-16 text-2xl text-c3 font-barlow w-full justify-center items-center">Titre </span></div>
        </div>

        <!-- Inclusion d'Alpine.js -->
        <script src="//unpkg.com/alpinejs" defer></script>

        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
        <div
            class="w-full h-80 flex bg-c3 transition shadow-lg rounded-sm cursor-pointer scale-90  ease-in-out duration-300 border hover:border-2  hover:scale-100 hover:border-c1 ">
        </div>
    </div>
</div>
<script src="//unpkg.com/alpinejs" defer></script>

