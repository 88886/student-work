<template>
    <div class="departments">
        <PresetGradePanel title="考核等级设置" getUrl="appraises/examines" url="appraise/examines"></PresetGradePanel>
    </div>
</template>
<script>
    import PresetGradePanel from '../../components/PresetGradePanel.vue'
    export default {
        components: {
            PresetGradePanel
        }
    }
</script>
<style scoped>
</style>