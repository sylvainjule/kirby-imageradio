<template>
    <ul :style="'--columns:' + columns" class="k-radio-input">
        <li v-for="(option, index) in options" :key="index">
            <input :id="id + '-' + index" :value="option.value" :name="id" :checked="value === option.value" type="radio" class="k-radio-input-native" @change="onInput(option.value)">
            <label :for="id + '-' + index">
                <figure :class="['k-radio-image-ctn', {'mobile-show': mobile}]">
                    <figure class="k-radio-image" :style="padding">
                        <img :src="option.image" :class="fit" alt="">
                        <div class="background"></div>
                    </figure>
                </figure>
                <div>
                    <template v-if="option.info">
                        <span class="k-radio-input-text">{{ option.text }}</span>
                        <span class="k-radio-input-info">{{ option.info }}</span>
                    </template>
                    <template v-else>
                        {{ option.text }}
                    </template>
                </div>
            </label>
        </li>
    </ul>
</template>

<script>
export default {
    extends: 'k-radio-input',
    props: {
        fit: String,
        ratio: Number,
        mobile: Boolean,
    },
    computed: {
        padding() {
            return 'padding-top:'+ this.ratio + '%;'
        }
    }
}
</script>