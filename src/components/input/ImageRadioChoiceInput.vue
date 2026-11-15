<template>
    <label :aria-disabled="disabled" :class="['k-choice-input', 'k-imageradio-choice-input', $attrs.class]" :style="$attrs.style">
        <figure class="k-imageradio-choice-image" :data-mobile="mobile ? 'true' : 'false'"
                :style="{ aspectRatio: ratio || '1/1', background: back || undefined }">
            <img :src="image" :class="fit" alt="" />
        </figure>

        <div class="k-imageradio-choice-wrapper">
            <input v-bind="{
                    autofocus,
                    id,
                    checked,
                    disabled,
                    name,
                    required,
                    type,
                    value,
                }"
                :data-variant="variant"
                :class="{ 'sr-only': variant === 'invisible' }"
                @input="$emit('input', $event.target.checked)"
            />
            <span v-if="label || info" class="k-choice-input-label">
                <span v-safe-html="label" class="k-choice-input-label-text" />
                <span v-if="info" v-safe-html="info" class="k-choice-input-label-info" />
            </span>
        </div>
    </label>
</template>

<script>
export default {
    extends: 'k-choice-input',
    inheritAttrs: false,
    emits: ['input'],
    props: {
        image: String,
        fit: String,
        ratio: [String, Number],
        mobile: Boolean,
        back: [Boolean, String],
    },
};
</script>


