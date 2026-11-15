<template>
    <k-field v-bind="$props" :class="['k-radio-field', 'k-imageradio-field', $attrs.class]" :input="id + '-0'" :style="$attrs.style">
        <k-empty v-if="!options?.length" :text="$t('options.none')" icon="checklist" />
        <k-imageradio-input v-else ref="input" v-bind="$props" :options="$helper.field.options(options, value)" @input="$emit('input', $event)" />
    </k-field>
</template>

<script>
export default {
    extends: 'k-radio-field',
    inheritAttrs: false,
    emits: ['input'],
    props: {
        fit: String,
        mobile: Boolean,
        ratio: [String, Number],
        back: [Boolean, String],
    },
};
</script>

<style lang="scss">
    @import '../../assets/css/styles.scss';
</style>
