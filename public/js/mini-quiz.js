/**
 * Mini Quiz Module for Absence QR App
 * Contains functions to generate and validate different types of quiz questions
 */

class MiniQuiz {
    /**
     * Generates a random math question
     * @returns {Object} Object containing question and answer
     */
    static generateMathQuestion() {
        const operations = ['+', '-', '*'];
        const operation = operations[Math.floor(Math.random() * operations.length)];
        let a, b, question, answer;

        switch (operation) {
            case '+':
                a = Math.floor(Math.random() * 20) + 1;
                b = Math.floor(Math.random() * 20) + 1;
                question = `${a} + ${b} = ?`;
                answer = a + b;
                break;
            case '-':
                a = Math.floor(Math.random() * 20) + 10;
                b = Math.floor(Math.random() * 10) + 1;
                question = `${a} - ${b} = ?`;
                answer = a - b;
                break;
            case '*':
                a = Math.floor(Math.random() * 10) + 1;
                b = Math.floor(Math.random() * 10) + 1;
                question = `${a} × ${b} = ?`;
                answer = a * b;
                break;
        }

        return {
            question,
            answer
        };
    }

    /**
     * Generates a puzzle question from a predefined list
     * @returns {Object} Object containing question and answer
     */
    static generatePuzzleQuestion() {
        const puzzles = [{
                question: "Berapakah jumlah hari dalam seminggu?",
                answer: "7"
            },
            {
                question: "Berapakah jumlah bulan dalam setahun?",
                answer: "12"
            },
            {
                question: "2 + 2 × 2 = ?",
                answer: "6"
            },
            {
                question: "Huruf apa yang muncul setelah D?",
                answer: "E"
            },
            {
                question: "Huruf apa yang muncul sebelum Q?",
                answer: "P"
            },
            {
                question: "Berapakah jumlah sisi dari segitiga?",
                answer: "3"
            },
            {
                question: "Berapakah jumlah sisi dari persegi?",
                answer: "4"
            }
        ];

        return puzzles[Math.floor(Math.random() * puzzles.length)];
    }

    /**
     * Generates a random quiz question (either math or puzzle)
     * @returns {Object} Object containing question and answer
     */
    static generateRandomQuiz() {
        return Math.random() < 0.5 ? this.generateMathQuestion() : this.generatePuzzleQuestion();
    }

    /**
     * Validates the user's answer against the correct answer
     * @param {string} userAnswer - The user's answer
     * @param {string} correctAnswer - The correct answer
     * @returns {boolean} Whether the answer is correct
     */
    static validateAnswer(userAnswer, correctAnswer) {
        return userAnswer.toLowerCase().trim() === correctAnswer.toLowerCase();
    }
}
