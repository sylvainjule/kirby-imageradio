<template>
    <label class="k-choice-input k-imageradio-choice-input" :aria-disabled="disabled">
        <figure class="k-imageradio-choice-image" :data-mobile="mobile" :style="[{'padding-top': padding}, {'background': background}]">
            <img :src="image" :class="fit">
        </figure>

        <div class="k-imageradio-choice-wrapper">
            <input
                v-bind="{
                    autofocus,
                    id,
                    checked,
                    disabled,
                    name,
                    required,
                    type,
                    value
                }"
                :data-variant="variant"
                :class="{ 'sr-only': variant === 'invisible' }"
                @input="$emit('input', $event.target.checked)"
            />
            <span v-if="label || info" class="k-choice-input-label">
                <!-- eslint-disable-next-line vue/no-v-html -->
                <span class="k-choice-input-label-text" v-html="label" />
                <!-- eslint-disable-next-line vue/no-v-html -->
                <span v-if="info" class="k-choice-input-label-info" v-html="info" />
            </span>
        </div>
    </label>
</template>


<script>
export default {
    extends: 'k-choice-input',
    props: {
        image: String,
        fit: String,
        ratio: Number,
        mobile: Boolean,
        back: [Boolean, String],
    },
    computed: {
        padding() {
            return this.$helper.ratio(this.ratio, 'auto', true)
        },
        background() {
            return this.back || false
        },
    },
}
</script>
