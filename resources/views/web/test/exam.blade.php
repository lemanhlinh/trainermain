@extends('web.layouts.web')

@section('content')
    <div class="content-home-test py-5" id="app-test">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="box-top-test text-center" v-if="!isSubmitting && !showResult">
                        <p><i class="far fa-clock fa-3x"></i></p>
                        <p class="title-count-down">Thời gian còn lại</p>
                        <div class="time-count-down">@{{ formattedTimeRemaining }}</div>
                    </div>
                    <div class="box-center-test">
                        <h3 class="title-ielt-quick">{{ $member_test->lessonTest->name }}</h3>
                        <ul class="list-unstyled">
                            <li>Số câu <span>@{{ showResult?totalCorrectAnswers+"/":'' }}{{ $member_test->lessonTest->number_question }}</span></li>
                            <li>Thời gian làm bài <span>{{ $member_test->lessonTest->time_submit }} phút</span></li>
                            <li>Họ và tên <span>{{ $member_test->full_name }}</span></li>
                            <li>Giới tính <span>{{ $member_test->gender == 1 ? 'Nam' : 'Nữ' }}</span></li>
                            <li>Năm sinh <span>{{ $date->format('Y') }}</span></li>
                        </ul>
                    </div>
                    <div class="box-under-test">
                        <span v-if="!isSubmitting">
                            <button class="btn btn-send-exam" @click="submitExam" :disabled="isSubmitting" >Nộp bài thi <i class="fas fa-external-link-square-alt"></i></button>
                        </span>
                        <span v-else>
                            <a class="btn btn-send-exam w-100" href="{{ route('examTest',$member_test->id) }}" >Làm lại bài thi <i class="fas fa-redo-alt"></i></a>
                        </span>
                        <button class="btn btn-out-exam border">Thoát</button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="content-question">
                        <div v-for="(question, questionIndex) in questions" :key="questionIndex" >
                            <div v-if="questionIndex === selectedQuestion" class="ck-content">
                                <p class="number-question">Câu hỏi @{{ questionIndex + 1 }}:</p>
                                <div v-if="question.type_id == 1">
                                    <p class="title-question" v-html="question.content"></p>
                                    <ul class="list-unstyled">
                                        <li v-for="(answer, answerIndex) in question.question_item_test" :key="answerIndex">
                                            <label>
                                                <input
                                                    type="radio"
                                                    :name="'question_' + questionIndex"
                                                    v-model="selectedAnswers[questionIndex]"
                                                    :value="answer.id"
                                                    @change="updateHasAnswer(questionIndex)"
                                                    :disabled="isSubmitting">
                                                @{{ answer.content_answer }}
                                                <span v-if="showResult">
                                                    <i v-if="checkSingleAnswer(questionIndex,answer.id)" class="fas fa-check-circle text-success"></i>
                                                    <i v-else class="fas fa-times-circle text-danger"></i>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else-if="question.type_id == 2">
                                    <ul class="list-unstyled">
                                        <li v-for="(answer, answerIndex) in question.question_item_test" :key="answerIndex">
                                            <label class="content-fill-input">
                                                <p class="title-question" v-if="question.type_id == 2" v-html="processedStringFi(question.content)"></p>
                                                <input
                                                    type="text"
                                                    :name="'question_' + questionIndex"
                                                    v-model="selectedAnswers[questionIndex]"
                                                    @change="updateHasAnswer(questionIndex)"
                                                    :disabled="isSubmitting">
                                                <p class="title-question" v-if="question.type_id == 2" v-html="processedStringAf(question.content)"></p>
                                                <p v-if="showResult" class="ms-4">
                                                    @{{ answer.content_answer }}
                                                    <i v-if="checkSingleAnswer(questionIndex,answer.id)" :data="checkSingleAnswer(questionIndex,answer.id)" class="fas fa-check-circle text-success"></i>
                                                    <i v-else class="fas fa-times-circle text-danger"></i>
                                                </p>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else-if="question.type_id == 3">
                                    <p class="title-question" v-html="question.content"></p>
                                    <ul class="list-unstyled">
                                        <li v-for="(answer, answerIndex) in question.question_item_test" :key="answerIndex">
                                            <label>
                                                <input
                                                    type="radio"
                                                    :name="'question_' + questionIndex"
                                                    v-model="selectedAnswers[questionIndex]"
                                                    :value="answer.id"
                                                    @change="updateHasAnswer(questionIndex)"
                                                    :disabled="isSubmitting">
                                                @{{ answer.content_answer }}
                                                <span v-if="showResult">
                                                    <i v-if="checkSingleAnswer(questionIndex,answer.id)" class="fas fa-check-circle text-success"></i>
                                                    <i v-else class="fas fa-times-circle text-danger"></i>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else-if="question.type_id == 4">
                                    <p class="title-question" v-html="question.content"></p>
                                    <ul class="list-unstyled">
                                        <li v-for="(answer, answerIndex) in question.question_item_test" :key="answerIndex">
                                            <label>
                                                <input
                                                    type="checkbox"
                                                    :name="'question_' + questionIndex"
                                                    v-model="selectedAnswers[questionIndex]"
                                                    :value="answer.id"
                                                    @change="updateHasAnswer(questionIndex)"
                                                    :disabled="isSubmitting">
                                                @{{ answer.content_answer }}
                                                <span v-if="showResult">
                                                    <i v-if="checkSingleAnswer(questionIndex,answer.id)" class="fas fa-check-circle text-success"></i>
                                                    <i v-else class="fas fa-times-circle text-danger"></i>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div v-else>
                                    <p class="title-question" v-html="question.content"></p>
                                    <ul class="list-unstyled">
                                        <li v-for="(answer, answerIndex) in question.question_item_test" :key="answerIndex">
                                            <label>
                                                <input
                                                    type="text"
                                                    :name="'question_' + questionIndex"
                                                    v-model="selectedAnswers[answerIndex]"
                                                    @change="updateHasAnswer(questionIndex)"
                                                    :disabled="isSubmitting">
                                                <span v-if="showResult">
                                                    @{{ answer.content_answer }}
                                                    <i v-if="checkSingleAnswer(questionIndex,answer.id)" class="fas fa-check-circle text-success"></i>
                                                    <i v-else class="fas fa-times-circle text-danger"></i>
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="next-question">
                        <button @click="goToNextQuestion" :disabled="selectedQuestion === questions.length - 1 || isSubmitting" class="btn btn-next-question">Câu kế tiếp <i class="fas fa-caret-right"></i></button>
                    </div>
                    <ul class="list-question" >
                        <li class="list-unstyled" v-for="(question, index) in questions" :key="index" @click="showAnswer(index)" :class="showResult ? checkAnswer(index) ? 'bg-warning' : 'bg-danger' : (selectedQuestion === index ? 'active' : '')">
                            <span v-if="showResult">
                                <i v-if="checkAnswer(index)" class="fas fa-check-circle text-white"></i>
                                <i v-else class="fas fa-times-circle text-white"></i>
                            </span>
                            <span v-else v-if="hasAnswer[index]">
                                <i class="fas fa-check-circle text-warning"></i>
                            </span>
                            Câu @{{ index + 1 }}
                        </li>
                    </ul>
                    <div class="list-comment" v-if="showResult">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-white bg-warning"></i> Câu đúng</li>
                            <li><i class="fas fa-times text-white bg-danger"></i> Câu sai</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/test-exam.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/content-ckeditor.css') }}">
@endsection

@section('script')
    @parent
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        const { createApp } = Vue
        createApp({
            data(){
                return {
                    questions: @json($listQuestion),
                    selectedQuestion: 0,
                    selectedAnswers: [], // Lưu đáp án đã chọn cho mỗi câu hỏi
                    isSubmitting: false,
                    showResult: false, // Đánh dấu hiển thị kết quả kiểm tra
                    timeRemaining: 0, // Thời gian còn lại (đơn vị: giây)
                    hasAnswer: [],
                    hasUnansweredQuestions: true,
                    startTime: null,
                    submitTime: null
                }
            },
            computed: {
                totalTime() {
                    // Tính tổng thời gian cho bài thi (đơn vị: giây)
                    return 60 * {{ $member_test->lessonTest->time_submit }};
                },
                formattedTimeRemaining() {
                    const hours = Math.floor(this.timeRemaining / 3600);
                    const minutes = Math.floor((this.timeRemaining % 3600) / 60);
                    const seconds = this.timeRemaining % 60;

                    const formattedHours = String(hours).padStart(2, '0');
                    const formattedMinutes = String(minutes).padStart(2, '0');
                    const formattedSeconds = String(seconds).padStart(2, '0');

                    return `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
                },
                totalCorrectAnswers() {
                    let total = 0;
                    for (let i = 0; i < this.questions.length; i++) {
                        if (this.checkAnswer(i)) {
                            total++;
                        }
                    }
                    return total;
                },
                hasUnansweredQuestions() {
                    return this.totalCorrectAnswers !== this.questions.length;
                },
            },
            methods: {
                processedStringFi(content){
                    return content.replace(/\{[^}]*\}[\s\S]+$/, '');
                },
                processedStringAf(content){
                    return content.replace(/^[\s\S]+\{[^}]*\}/, '');
                },
                showAnswer(index) {
                    this.selectedQuestion = index;
                    //this.showResult = false; // Ẩn kết quả kiểm tra khi chọn câu hỏi mới
                },
                updateHasAnswer(questionIndex) {
                    this.hasAnswer[questionIndex] = true;
                },
                initSelectedAnswers() {
                    // Kiểm tra nếu questions không được định nghĩa hoặc là một mảng rỗng, thì trả về một mảng rỗng
                    if (!this.questions || this.questions.length === 0) {
                        return [];
                    }

                    const selectedAnswers = [];
                    // Khởi tạo selectedAnswers cho mỗi câu hỏi là một mảng rỗng hoặc một mảng trống (loại radio)
                    this.questions.forEach((question) => {
                        selectedAnswers.push([]);
                    });


                    return selectedAnswers;
                },

                checkSingleAnswer(questionIndex, answerIndex) {
                    const correctAnswerIds = this.questions[questionIndex].question_item_test
                        .filter(answer => answer.answer === 1)
                        .map(answer => answer.id);
                        if (this.questions[questionIndex].type_id === 2) {
                            // Nếu không có đáp án chính xác, so sánh với đáp án người dùng nhập vào
                            return this.selectedAnswers[questionIndex].toString().toLowerCase() === this.questions[questionIndex].question_item_test[0].content_answer.toLowerCase();
                        } else {
                            // Nếu có đáp án chính xác, so sánh với đáp án đã chọn
                            return correctAnswerIds.includes(answerIndex);
                        }
                },

                checkAnswer(index) {
                    const selectedAnswerIds = this.selectedAnswers[index];
                    const correctAnswerIds = this.questions[index].question_item_test
                        .filter(answer => answer.answer === 1)
                        .map(answer => answer.id);
                    // Chuyển đổi selectedAnswerIds thành một mảng nếu không phải là mảng
                    const selectedIdsArray = Array.isArray(selectedAnswerIds) ? selectedAnswerIds : [selectedAnswerIds];
                    // Chuyển đổi correctAnswerIds thành một mảng nếu không phải là mảng
                    const correctIdsArray = Array.isArray(correctAnswerIds) ? correctAnswerIds : [correctAnswerIds];
                    // Kiểm tra hai mảng đã sắp xếp có bằng nhau không
                    if (this.questions[this.selectedQuestion].type_id === 2) {
                        const correctIdsArray =  [this.questions[this.selectedQuestion].question_item_test[0].content_answer.toLowerCase()];
                    }else{
                        // Chuyển đổi correctAnswerIds thành một mảng nếu không phải là mảng
                        const correctIdsArray = Array.isArray(correctAnswerIds) ? correctAnswerIds : [correctAnswerIds];
                    }
                    return this.arrayEquals(selectedIdsArray, correctIdsArray);
                },
                submitExam() {
                    this.isSubmitting = true; // Đánh dấu là đang kiểm tra toàn bài
                    this.showResult = true;
                    this.submitTime = new Date();

                    const examResult = {};
                    this.questions.forEach((question, index) => {
                        const questionId = question.id;
                        const selectedAnswerIds = this.selectedAnswers[index];
                        examResult[questionId] = selectedAnswerIds;
                    });

                    // Chuẩn bị dữ liệu kết quả thi để gửi đến API
                    const examResultEdit = {
                        lesson_id: `{{ $member_test->lessonTest->id }}`,
                        lesson_name: `{{ $member_test->lessonTest->name }}`,
                        correct: this.totalCorrectAnswers,
                        total_questions: this.questions.length,
                        wrong: (this.questions.length - this.totalCorrectAnswers),
                        content_answer: examResult,
                        content: this.questions,
                        time_start: this.startTime.toISOString().slice(0, 19).replace('T', ' '),
                        time_end: this.submitTime.toISOString().slice(0, 19).replace('T', ' '),
                    };
                    console.log(examResultEdit);
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    // Gửi yêu cầu POST đến API
                    fetch('{{ route('saveTest',$member_test->id) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify(examResultEdit),
                    })
                    .then(response => {
                        // Xử lý kết quả trả về từ API
                        if (response.ok) {
                            // Kết quả đã được lưu thành công
                            console.log('Kết quả thi đã được lưu thành công');
                        } else {
                            // Xử lý khi có lỗi xảy ra
                            console.error('Lỗi khi lưu kết quả thi');
                        }
                    })
                    .catch(error => {
                        // Xử lý khi có lỗi xảy ra trong quá trình gửi yêu cầu
                        console.error('Lỗi khi gửi yêu cầu lưu kết quả thi', error);
                    });
                },
                arrayEquals(arr1, arr2) {
                    if (arr1.length !== arr2.length) return false;
                    // So sánh câu trả lời dưới dạng mảng
                    const sortedArr1 = JSON.stringify(arr1.sort());
                    const sortedArr2 = JSON.stringify(arr2.sort());
                    return sortedArr1 === sortedArr2;
                },
                goToNextQuestion() {
                    if (this.selectedQuestion < this.questions.length - 1) {
                        this.selectedQuestion++;
                        this.showResult = false;
                    }
                },
                startTimer() {
                    // Bắt đầu đếm thời gian ngược
                    this.timeRemaining = this.totalTime;
                    this.timer = setInterval(() => {
                        this.timeRemaining--;
                        if (this.timeRemaining <= 0) {
                            // Hết giờ, tự động submit bài
                            this.submitExam();
                            clearInterval(this.timer);
                        }
                    }, 1000); // Cứ mỗi giây thực hiện đếm thời gian
                },

                stopTimer() {
                    // Dừng đếm thời gian
                    clearInterval(this.timer);
                },
            },
            mounted() {
                // Khởi tạo selectedAnswers sau khi đã có dữ liệu questions
                this.selectedAnswers = this.initSelectedAnswers();
                // Bắt đầu đếm thời gian khi mount component
                this.startTimer();
            },
            created() {
                this.startTime = new Date();
            },
            beforeDestroy() {
                // Trước khi component bị hủy, dừng đếm thời gian
                this.stopTimer();
            },
        }).mount('#app-test')
    </script>
@endsection
