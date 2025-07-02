/**
 * Quiz Data for the Absence QR App
 * Contains various categories of questions that can be used in the mini quiz
 */

class QuizData {
    /**
     * Gets all available math questions
     * @returns {Array} Array of math question generators
     */
    static getMathQuestions() {
        return [
            // Addition questions
            () => {
                const a = Math.floor(Math.random() * 20) + 1;
                const b = Math.floor(Math.random() * 20) + 1;
                return {
                    question: `${a} + ${b} = ?`,
                    answer: (a + b).toString()
                };
            },

            // Subtraction questions
            () => {
                const a = Math.floor(Math.random() * 20) + 10;
                const b = Math.floor(Math.random() * 10) + 1;
                return {
                    question: `${a} - ${b} = ?`,
                    answer: (a - b).toString()
                };
            },

            // Multiplication questions
            () => {
                const a = Math.floor(Math.random() * 10) + 1;
                const b = Math.floor(Math.random() * 10) + 1;
                return {
                    question: `${a} × ${b} = ?`,
                    answer: (a * b).toString()
                };
            }
        ];
    }

    /**
     * Gets all available general knowledge questions
     * @returns {Array} Array of general knowledge questions
     */
    static getGeneralKnowledgeQuestions() {
        return [
            {
                question: "Berapakah jumlah hari dalam seminggu?",
                answer: "7"
            },
            {
                question: "Berapakah jumlah bulan dalam setahun?",
                answer: "12"
            },
            {
                question: "Apa nama ibu kota Indonesia?",
                answer: "Jakarta"
            },
            {
                question: "Benua terbesar di dunia adalah?",
                answer: "Asia"
            },
            {
                question: "Hewan berkaki empat disebut juga?",
                answer: "Mamalia"
            }
        ];
    }

    /**
     * Gets all available logic puzzles
     * @returns {Array} Array of logic puzzles
     */
    static getLogicPuzzles() {
        return [
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
    }

    /**
     * Gets all available questions from all categories
     * @returns {Array} Combined array of all questions
     */
    static getAllQuestions() {
        const mathQuestions = this.getMathQuestions();
        const generalKnowledge = this.getGeneralKnowledgeQuestions();
        const logicPuzzles = this.getLogicPuzzles();

        // Return the combined array
        return { mathQuestions, generalKnowledge, logicPuzzles };
    }
}
