<template>
    <fieldset :class="['k-radio-input', 'k-imageradio-input', $attrs.class]" :disabled="disabled" :style="$attrs.style">
        <legend class="sr-only">{{ $t('options') }}</legend>
        <k-input-validator :required="required" :value="JSON.stringify(value)">
            <ul :style="{ '--columns': columns }" class="k-grid" data-variant="choices">
                <li v-for="(choice, index) in choices" :key="index">
                    <k-imageradio-choice-input v-bind="choice" @input="$emit('input', choice.value)" />
                </li>
            </ul>
        </k-input-validator>
    </fieldset>
</template>

<script>
export default {
    extends: 'k-radio-input',
    inheritAttrs: false,
    emits: ['input'],
    props: {
        fit: String,
        ratio: [String, Number],
        mobile: Boolean,
        back: [Boolean, String],
    },
    computed: {
        choices() {
            return this.options.map((option, index) => ({
                autofocus: this.autofocus && index === 0,
                checked: this.value === option.value,
                disabled: this.disabled || option.disabled,
                id: `${this.id}-${index}`,
                info: option.info,
                label: option.text,
                name: this.name ?? this.id,
                type: 'radio',
                value: option.value,
                image: option.image,
                fit: this.fit,
                ratio: this.ratio,
                mobile: this.mobile,
                back: this.back,
            }));
        },
    },
};
</script>
