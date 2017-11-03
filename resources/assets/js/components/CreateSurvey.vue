<template>
    <div>
        <div class="columns">
            <div class="column is-8 is-offset-2">
                <div class="box">
                    <div class="field">
                        <label class="label is-required">Name</label>
                        <p class="control">
                            <input class="input" type="text"
                                   placeholder="Ex. Patriots Fan Survey"
                                   v-model="survey.name"
                            />
                            <span v-if="errors['survey.name']" class="help-block">{{ errors['survey.name'][0] }}</span>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <textarea class="textarea"
                                      placeholder="Description (optional)"
                                      v-model="survey.description"/>
                            <span v-if="errors['survey.description']"
                                  class="help-block">{{ errors['survey.description'][0] }}</span>
                        </p>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-8">
                        <span class="title is-4">Questions:</span>
                    </div>
                </div>
                <div class="box" v-for="question in survey.questions">
                    <div class="columns">
                        <div class="column is-10 nopad">
                            <strong>{{ question.question }}</strong>
                        </div>
                        <div class="column is-2 nopad">
                            <button class="button is-secondary"
                                    @click="removeQuestion(question)">
                                    remove
                            </button>
                        </div>
                    </div>
                    <hr class="survey">

                    <ul class="survey">
                        <li v-for="option in question.options">
                          <span class="is-offset-2">{{ option.label }}</span>
                          <template v-if="option.value">({{ option.value }})</template>
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
        errors: {},
      }
    },

    mounted() {
      AppEvents.$on('save-question', this.saveQuestion)
    },

    computed: {

      saveValidation() {
        return !this.survey.name.trim() || this.survey.questions.length < 2
      },

    },

    methods: {

      createSurvey() {
        let data = {
          survey: this.survey,
          user_id: window.user_id
        };
        axios.post('/api/survey/create', data)
          .then(res => {
            this.submitted = true;
            window.location = res.data;
         }).catch(error => {
           this.errors = error.response.data.errors;
        })
      },

      saveQuestion(question) {
        // validation
        if (true) {
          this.survey.questions.push(question);
        }
      },

      removeQuestion(question) {
          let index = this.survey.questions.indexOf(question);
          this.survey.questions.splice(index, 1);
      }
    },

    components: {
      'survey-question': require('./CreateSurveyQuestion.vue')
    }
  }
</script>
