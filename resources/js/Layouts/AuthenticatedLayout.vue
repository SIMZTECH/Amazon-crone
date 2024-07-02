<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import MapMarkerOutline from 'vue-material-design-icons/MapMarkerOutline.vue';
    import MenuDown from 'vue-material-design-icons/MenuDown.vue';
    import Magnify from 'vue-material-design-icons/Magnify.vue';
    import CartMinus from 'vue-material-design-icons/CartMinus.vue';
    import Menu from 'vue-material-design-icons/Menu.vue';
    import AccountCircle from 'vue-material-design-icons/AccountCircle.vue';
    import Close from 'vue-material-design-icons/Close.vue';
    import CheveronRight from 'vue-material-design-icons/ChevronRight.vue';
    import { ref } from 'vue';
    import { useCart } from '@/store/Cart';

    const showMenu = ref<boolean>(false);
    const accountList = ref<boolean>(false);

    const onHoverAccounShowList=(arg:boolean):void=>{
        setTimeout(() => {
            accountList.value = arg;
        },150);
    };

    const cart = useCart();




</script>

<template>
    <div class="min-w-[1150px] bg-gray-100 h-full">
        <div v-if="accountList" class="fixed top-0 z-20 w-full h-full bg-black bg-opacity-70"></div>
        <!-- top nav -->
        <div class="flex items-center bg-gray-900 h-[60px] py-2 fixed z-50 w-full">
            <!-- logo -->
            <div class="flex">
                <Link
                    href="/"
                    class="h-[50px] text-white p-2 pt-3 border-[1px] border-gray-900 hover:border-[1px] hover:border-gray-100 rounded-sm cursor-pointer">
                    <img src="/images/am_logo/AMAZON_LOGO.png" width="100" />
                </Link>
            </div>

            <div v-if="$page.props.auth.user"
                class="text-white h-[50px] p-2 border-[1px] border-gray-900 rounded-sm hover:border-gray-100">
                <Link v-if="$page.props.auth.address" :href="route('address.index')">
                <div class="flex items-center justify-center">
                    <MapMarkerOutline class="pt-2 -ml-1" filColor="#f5f5f5" />
                    <div class="flex flex-col">
                        <div class="text-[13px] text-gray-300 font-extrabold">
                            <div>Delivery to {{ $page.props.auth.user.first_name}}</div>
                        </div>

                        <div class="text-[15px] text-white font-extrabold">
                            <div>{{ $page.props.auth.address.city }} {{$page.props.auth.address.postcode}}</div>
                        </div>
                    </div>
                </div>
                </Link>
                <!-- select your address -->
                <Link :href="route('address_options.index')" v-else class="flex items-center justify-center">
                <MapMarkerOutline class="pt-2 -ml-1" filColor="#f5f5f5" />
                <div>
                    <div class="text-[13px] text-gray-300 font-extrabold">
                        <div>Hello</div>
                        <div class="text-[15px] text-white -mt-1.5 font-extrabold">Select your address</div>
                    </div>
                </div>
                </Link>
            </div>

            <div class="flex grow items-center h-[45px] px-1">
                <div class="flex items-center justify-center font-extrabold bg-gray-100 border-r border-r-gray-300">
                    <div class="pt-[3px]">
                        All
                    </div>
                    <MenuDown fillColor="#5e5e5e" size="20" class="-mr-2" />
                </div>
                <input type="text"
                    class="block w-full border-transparent border-none focus:border-transparent focus:ring-0" />
                <div class=" cursor-pointer bg-orange-300 p-[5px] px-2 rounded-r-md">
                    <Magnify size="30" />
                </div>
            </div>

            <div class="flex">

                <div
                    class="h-[50px] p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100">
                    <div class="flex items-center justify-center mt-2.5 px-1">
                        <img src="/images/am_flags/US.png" width="20" alt="" />
                        <div class="text-[15px] text-white font-extrabold">EN</div>
                        <MenuDown fillColor="#c2c2c2" size="20" class="-mr-4 -mt-1.5 pr-1" />
                    </div>
                </div>

                <div
                    class="h-[50px] p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100">
                    <div>
                        <!-- orders and returns -->
                        <div class="flex items-center justify-center">
                            <div>
                                <div class="text-[12px] text-white font-extrabold">Orders</div>
                                <div class="flex items-center">
                                    <div class="text-[15px] text-white -mt-1.5 font-extrabold">& Returns</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-on:mouseenter="onHoverAccounShowList(true)" v-on:mouseleave="onHoverAccounShowList(false)"
                    class="h-[50px] p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100">
                    <div>
                        <div class="flex items-center justify-center">
                            <div>
                                <div class="text-[12px] text-white font-extrabold">
                                    Hello,
                                    <span v-if="$page.props.auth.user">{{$page.props.auth.user.first_name}}</span>
                                    <span v-else>sign in</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="text-[15px] text-white -mt-1.5 font-extrabold">Account & List</div>
                                    <MenuDown fillColor="#c2c2c2" size="20" class="-mr-4 -mt-1.5 pr-1" />
                                </div>
                            </div>
                            <!-- mega menu hover -->
                            <div v-if="accountList"
                                class="bg-white absolute z-50 top-[56px] -ml-[230px] w-[480px] rounded-sm px-6">
                                <div>
                                    <div class="flex items-center justify-between py-2.5 border-b">
                                        <div>Who's shopping? Select a profile.</div>
                                        <div
                                            class="flex items-center text-sm font-bold text-teal-600 hover:text-red-600 hover:underline">
                                            Manage profile
                                            <CheveronRight :size="20" fillColor="#808080" />
                                        </div>
                                    </div>
                                    <!-- content -->
                                    <div v-if="$page.props.auth.user" class="flex">
                                        <div class="w-1/2 border-r">
                                            <div class="pb-3">
                                                <div class="pt-3 font-extrabold">Your List</div>
                                                <div class="text-sm hover:text-red-600 hover:underline">Create List
                                                </div>
                                            </div>
                                        </div>

                                        <div class="w-1/2 border-r">
                                            <div class="pb-3">
                                                <div class="pt-3 font-extrabold">Your Account</div>
                                                <Link :href="route('profile.edit')"
                                                    class="block text-sm hover:text-red-600 hover:underline">
                                                Account
                                                </Link>
                                                <Link method="post" :href="route('logout')" as="button"
                                                    class="block text-sm hover:text-red-600 hover:underline">
                                                Sign Out
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- sign-out -->
                                    <div class="p-4 text-center" v-else>
                                        <div></div>
                                        <Link :href="route('login')"
                                            class="text-center text-sm font-extrabold text-black items-center px-20 py-1.5 bg-[#fcba1f] border border-gray-600 rounded-sm">
                                        Sign in
                                        </Link>
                                        <div class="pt-4 text-sm">
                                            New customer?
                                            <Link class="text-blue-700 hover:text-red-700" :href="route('register')">
                                            Start here.
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add to cart -->
                <Link
                    :href="route('cart.index')"
                    class="h-[50px] relative p-2 border-[1px] border-gray-900 rounded-sm hover:border-[1px] hover:border-gray-100">
                    <span class="absolute text-center right-[12px] w-[14px] -top-0 rounded-full">
                        <div class="text-orange-400 text-[12px] font-extrabold bg-gray-900 h-[16px]">{{cart.cartBasket.length}}</div>
                    </span>
                    <div class="flex items-center">
                        <CartMinus fillColor="#ffff" size="20" />
                    </div>
                </Link>

            </div>
        </div>
        <!-- sub nav -->
        <div class="flex items-center justify-between bg-[#232f3e] h-[38px] fixed z-40 min-w-[1150px] w-full mt-[60px]">
            <div class="flex">
                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <!-- toggle btn -->
                    <div v-on:click="showMenu=!showMenu" class="flex items-center justify-between px-2">
                        <Menu fillColor="#f5f5f5" :size="26" class="mr-0.5" />
                        <div class="text-[14px] text-white font-extrabold">All</div>
                    </div>
                </div>

                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <div class="text-[14px] text-white font-extrabold">Today's Deals</div>
                    </div>
                </div>

                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <div class="text-[14px] text-white font-extrabold">Gift Cards</div>
                    </div>
                </div>

                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <div class="text-[14px] text-white font-extrabold">Buy Again</div>
                    </div>
                </div>

                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <div class="text-[14px] text-white font-extrabold">Customer Service</div>
                    </div>
                </div>

                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <div class="text-[14px] text-white font-extrabold">John's Amazon.com</div>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div
                    class="flex h-[30px] border-[1px] border-[#232f3e] rounded-sm hover:border-[1px] hover:border-gray-200">
                    <div class="flex items-center justify-between px-2">
                        <div class="text-[14px] text-white font-extrabold">Holiday Fashion Deals</div>
                    </div>

                </div>
            </div>

        </div>
        <main class="max-w-[1500px] mx-auto">
            <div class="pt-[98px]"></div>
            <slot />
        </main>

        <!-- bottom section -->
        <div class="w-full mt-10 bg-white">
            <div class="max-w-[1500px] mx-auto overflow-x-scroll">
                <div class="text-[23px] pt-4 font-extrabold">Recommend based on your shopping trends</div>
                <div class="flex items-stretch justify-center">
                    <!-- box -->
                    <div v-for="product in $page.props.random_products" :key="product">
                        <div class="p-4 mx-auto text-center">
                            <div class="w-[158px] h-[150px] overflow-hidden">
                                <img :src="product.image" alt="" />
                            </div>
                            <Link :href="route('product.index',{id:product.id})">
                                <div
                                    class="w-[160px] text-[12px] py-2 text-teal-600 font-extrabold hover:text-red-600 cursor-pointer">
                                    {{ product.title.substring(0, 40) }}...
                                </div>
                            </Link>
                            <div class="flex justify-start">
                                <div class="w-full text-xs font-extrabold text-left text-red-600">${{ product.price }}
                                </div>
                                <img width="50" src="/images/am_logo/PRIME_LOGO.png" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer class="bg-[#232f3e]">
            <div
                class="bg-[#37475a] hover:bg-gray-600 w-full p-3.5 cursor-pointer text-white text-center font-extrabold">
                Back to top
            </div>
            <div class="flex items-stretch justify-between max-w-[1000px] mx-auto p-10 text-white">
                <ul>
                    <li class="text-lg font-extrabold">Get to know us</li>
                    <li class="cursor-pointer hover:underline">Careers</li>
                    <li class="cursor-pointer hover:underline">About Amazon</li>
                    <li class="cursor-pointer hover:underline">Invester Relations</li>
                    <li class="cursor-pointer hover:underline">Amazon Devices</li>
                    <li class="cursor-pointer hover:underline">Amazon Sciences</li>
                </ul>

                <ul>
                    <li class="text-lg font-extrabold">Make money with us</li>
                    <li class="cursor-pointer hover:underline">Sell products on amazon</li>
                    <li class="cursor-pointer hover:underline">Sell on amazon bussiness</li>
                    <li class="cursor-pointer hover:underline">Sell apps on amazon</li>
                    <li class="cursor-pointer hover:underline">Become an affiliate</li>
                    <li class="cursor-pointer hover:underline">Advertise your products</li>
                    <li class="cursor-pointer hover:underline">Self-publish with us</li>
                    <li class="cursor-pointer hover:underline">Host an Amazon Hub</li>
                </ul>

                <ul>
                    <li class="text-lg font-extrabold">Get to know us</li>
                    <li class="cursor-pointer hover:underline">Careers</li>
                    <li class="cursor-pointer hover:underline">About Amazon</li>
                    <li class="cursor-pointer hover:underline">Invester Relations</li>
                    <li class="cursor-pointer hover:underline">Amazon Devices</li>
                    <li class="cursor-pointer hover:underline">Amazon Sciences</li>
                </ul>

                <ul>
                    <li class="text-lg font-extrabold">Make money with us</li>
                    <li class="cursor-pointer hover:underline">Sell products on amazon</li>
                    <li class="cursor-pointer hover:underline">Sell on amazon bussiness</li>
                    <li class="cursor-pointer hover:underline">Sell apps on amazon</li>
                    <li class="cursor-pointer hover:underline">Become an affiliate</li>
                    <li class="cursor-pointer hover:underline">Advertise your products</li>
                    <li class="cursor-pointer hover:underline">Self-publish with us</li>
                    <li class="cursor-pointer hover:underline">Host an Amazon Hub</li>
                </ul>
            </div>
        </footer>
    </div>
    <!-- drawer custom -->
    <div v-if="showMenu" :class="[showMenu?'animate__animated animate__fadeIn animate__faster':'']"
        class="absolute top-0 z-50 w-full h-full bg-black bg-opacity-70">
        <Close v-on:click="showMenu=!showMenu" :size="30" fillColor="#dcdcdc"
            class="ml-2.5 mt-3.5 left-80 cursor-pointer fixed z-50"
            :class="[showMenu?'animate__animated animate__fadeIn animate__faster':'']" />
        <div :class="[showMenu?'animate__animated animate__slideInLeft animate__faster':'']"
            class="h-full bg-white w-80">
            <div class="bg-[#232f3e] font-extrabold text-[18px] flex items-center p-2 text-white pl-7">
                <span>Hello, Sign in</span>
            </div>
            <div class=" font-extrabold text-[16px] pt-3 pb-1 pl-6 pr-3 text-black">
                Shop By Department
            </div>
            <div>
                <div class="pl-6 pr-3 hover:bg-gray-200" v-for="(category,index) in $page.props.categories"
                    :key="category">
                    <Link :href="route('category.index',{id:category?.id})"
                        class="py-2.5 text-[13px] text-black flex justify-between items-center hover:bg-gray-200 cursor-pointer">
                    {{ category.name }}
                    <CheveronRight :size="20" fillColor="#808080" />
                    </Link>
                </div>
            </div>
        </div>

    </div>
</template>
