<template>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-for="Lesson in formattedLessons">
                {{ Lesson.title}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['default_lessons'],
        data() {
            return {
                lessons: this.default_lessons
            }
        },
        computed: {
            formattedLessons() {
                return JSON.parse(this.lessons)
            }
        }
    }
</script>