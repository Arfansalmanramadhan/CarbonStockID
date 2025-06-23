function printMotivation() {
    const messages = [
        { text: "Selamat ulang tahun, Syfanadya Wening Adi.", charDelay: 100 },
        { text: "Hari ini bukan hanya tentang pertambahan usia.", charDelay: 90 },
        { text: "Tapi tentang bagaimana kau telah tumbuh begitu kuat.", charDelay: 95 },
        { text: "Aku tahu, hidup tidak selalu mudah untukmu.", charDelay: 90 },
        { text: "Ayah mungkin tak di sisi, tapi semangatmu... itu warisan terindah darinya.", charDelay: 95 },
        { text: "Kau bukan hanya anak pertama, tapi fondasi untuk banyak hal di sekitarmu.", charDelay: 100 },
        { text: "Tanpa ayah, tanpa banyak pegangan, tapi tetap teguh.", charDelay: 100 },
        { text: "Magang sebagai Front-End Developer dan memiliki skill UI/UX Designer bukan hal mudah.", charDelay: 80 },
        { text: "Tapi kau menjalaninya dengan tenang, seolah semua mudah saja.", charDelay: 90 },
        { text: "Di usia yang baru ini, semoga semua impianmu mulai menemukan jalannya.", charDelay: 85 },
        { text: "Kau melangkah jauh, dalam diam, dalam perjuangan yang tak banyak orang tahu.", charDelay: 95 },
        { text: "Aku pernah punya rasa yang lebih dari sekadar teman.", charDelay: 105 },
        { text: "Dan meski tak berjalan seperti harapan...", charDelay: 110 },
        { text: "Aku tetap bersyukur bisa berjalan di sampingmu sebagai teman lab, temen cerita dan rekan lomba.", charDelay: 105 },
        { text: "Karena kadang, tempat terbaik bukan di hati seseorang, tapi di tim yang saling mendukung.", charDelay: 115 },
        { text: "Kau hebat. Lebih dari yang dunia tahu.", charDelay: 100 },
        { text: "Jadilah bahagia, karena kau pantas mendapatkannya.", charDelay: 140 },
        { text: "Dan aku ada di sini, diam-diam mendukungmu... selalu.", charDelay: 120 }
    ];

    const delays = [
        3500, 3000, 3000, 3000, 3500, 3000, 3000, 3000,
        3500, 3000, 3500, 3000, 3000, 3000,
        3000, 3000, 3500
    ];

    function printLine(line, charDelay, callback) {
        let index = 0;

        function printNextChar() {
            if (index < line.length) {
                process.stdout.write(line[index]);
                index++;
                setTimeout(printNextChar, charDelay);
            } else {
                console.log('');
                if (callback) callback();
            }
        }

        printNextChar();
    }

    function printAllMessages(messages, delays, currentIndex = 0) {
        if (currentIndex < messages.length) {
            const { text, charDelay } = messages[currentIndex];
            printLine(text, charDelay, () => {
                setTimeout(() => {
                    printAllMessages(messages, delays, currentIndex + 1);
                }, delays[currentIndex]);
            });
        }
    }

    printAllMessages(messages, delays);
}

printMotivation();
