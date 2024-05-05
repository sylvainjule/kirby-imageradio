<template>
    <k-field class="k-radio-field k-imageradio-field" v-bind="$props" :input="id + '-0'">
        <k-empty v-if="!options?.length" :text="$t('options.none')" icon="checklist" />
        <k-imageradio-input v-else ref="input" v-bind="$props" v-on="$listeners" />
    </k-field>
</template>

<script>
export default {
    extends: 'k-radio-field',
    props: {
        fit: String,
        mobile: Boolean,
        ratio: Number,
        back: [Boolean, String]
    }
};
</script>

<style lang="scss">
    @import '../../assets/css/styles.scss'
</style>