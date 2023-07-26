<template>
    <div class="w-full h-[400px]">
        <swiper :cssMode="true" :navigation="true" :pagination="true" :mousewheel="true" :keyboard="true" :modules="modules"
            class="mySwiper">
            <swiper-slide>
                <img class="rounded-" src="/img/projects/blog.jpg" alt="">
            </swiper-slide>
            <swiper-slide>
                <img src="/img/projects/ci.jpg" alt="">
            </swiper-slide>
            <swiper-slide>
                <img src="/img/projects/payments.jpg" alt="">
            </swiper-slide>
        </swiper>
    </div>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/navigation';
import 'swiper/css/pagination';

// import './style.css';

// import required modules
import { Navigation, Pagination, Mousewheel, Keyboard } from 'swiper/modules';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Navigation, Pagination, Mousewheel, Keyboard],
        };
    },
};
</script>

<style scoped>
.swiper {
  width: 100%;
  height: 100%;
}

.swiper-slide {
  text-align: center;
  font-size: 18px;
  background: #fff;

  /* Center slide text vertically */
  display: flex;
  justify-content: center;
  align-items: center;
}

.swiper-slide img {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 1rem;
}
</style>
  