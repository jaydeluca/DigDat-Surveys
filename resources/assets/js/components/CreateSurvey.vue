<template>
    <div>

        <div class="columns">
            <div class="column is-8 is-offset-2">

                <div class="box">
                    <div class="field">
                        <label class="label is-required">Name</label>
                        <p class="control">
                            <input class="input" type="text" placeholder="Ex. Patriots Fan Survey"
                                   v-model="survey.name">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <textarea
                                    class="textarea"
                                    placeholder="Description (optional)"
                                    v-model="survey.description">
                            </textarea>
                        </p>
                    </div>
                </div>

                <span class="title is-4">Questions:</span>

                <div class="box" v-for="question in survey.questions">
                    <strong>{{ question.question }}</strong>
                    <hr>

                    <ul>
                        <li v-for="option in question.options">
                            {{ option.label }} <template v-if="option.value">({{ option.value }})</template>
                        </li>
                    </ul>
                </div>

                <!-- Question -->
                <survey-question
                        v-for="n in question_count"
                        :data="n"
                        :key="n">
                </survey-question>

                <button class="button is-primary" @click="createSurvey" :disabled="saveValidation">Submit</button>

            </div>
        </div>

    </div>
</template>

<script>

  export default {

    name: 'CreateSurvey',

    data() {
      return {
        submitted: false,
        survey: {
          name: '',
          description: '',
          questions: []
        },
        question: {
          question: '',
          options: []
        },
        option: '',
        question_count: 1,
      }
    },

    mounted() {
      AppEvents.$on('save-question', this.saveQuestion)
    },

    computed: {

      saveValidation() {
        return !this.survey.name || this.survey.questions.length < 2
      },

    },

    methods: {

      createSurvey() {
        let data = {
          survey: this.survey,
          user_id: window.user_id
        };
        axios.post('/api/survey/create', data).then(res => {
          this.submitted = true;
          window.location = res.data;
        })
      },

      saveQuestion(question) {
        // validation
        if (true) {
          this.survey.questions.push(question);
        }
      },

    },

    components: {
      'survey-question': require('./CreateSurveyQuestion.vue')
    }

  }
</script>
