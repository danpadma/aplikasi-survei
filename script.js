// cegah link current tab untuk mereload
document.getElementById("current-tab").addEventListener("click", function(e) {
    e.preventDefault()
})

// ambil questions
const questions = document.getElementsByClassName("questions")[0]

// hitung nomor pertanyaan dan jawaban
let questionCount = 1
let gambarCount = 1
let answerCount = 1
let optionCount = 0

questions.addEventListener("click", function(e) {
    // ambil question box
    const questionBox = e.target.parentElement.parentElement
    // ambil next sibling question box
    const nextSibling = questionBox.nextElementSibling
    // ambil previous sibling question box
    const prevSibling = questionBox.previousElementSibling
    // fitur tambah pertanyaan
    if (e.target.className == "tambah-btn") {
        // tambah jumlah pertanyaan dan jawaban
        questionCount++
        gambarCount++
        answerCount++
        // bikin question box baru
        const qboxAttr = document.createAttribute("class")
        qboxAttr.value = "question-box"
        const pertanyaanBaru = document.createElement("div")
        pertanyaanBaru.setAttributeNode(qboxAttr)
        // set inner HTML nya
        pertanyaanBaru.innerHTML = `
            <div class="question-div">
              <input type="text" name="question`+ questionCount +`" class="question" placeholder="Pertanyaan ...">
              <input type="file" name="gambar`+ gambarCount +`" id="gambar`+ gambarCount +`" hidden>
              <label for="gambar`+ gambarCount +`"><i class="fa-regular fa-image"></i></label>
              <div></div>
            </div>
            <div class="answer-div">
              <input type="text" name="answer`+ answerCount +`" class="answer" value="Jawaban singkat" readonly>
            </div>
            <div class="utility">
              <select class="select">
                <option class="choice" value="Jawaban Singkat">Jawaban Singkat</option>
                <option class="choice" value="Pilihan Ganda">Pilihan Ganda</option>
              </select>
              <button type="button" class="up-btn">^</button>
              <button type="button" class="down-btn">v</button>
              <button type="button" class="hapus-btn">x</button>
              <button type="button" class="tambah-btn">+</button>
            </div>
        `;
        // kalo yg dipencet itu pertanyaan terakhir
        if (nextSibling == null) {
            // tambah child questions
            questions.appendChild(pertanyaanBaru)    
        }
        // kalo yg dipencet itu bukan pertanyaan terakhir
        else {
            // tambah child question sebelum nextSibling
            questions.insertBefore(pertanyaanBaru, nextSibling)
        }
    }
    // fitur delete (fitur delete ada di bawah fitur add biar childElementCount ga salah)
    if (e.target.className == "hapus-btn" && questions.childElementCount > 1) { 
        // remove question box jika tombol hapus dipencet dan child element questions lebih dari 1 (ngga cuma 1 pertanyaan)
        questionBox.remove()
    }
    // fitur geser atas
    if (e.target.className == "up-btn" && prevSibling != null) {
        // pindah question box ke sebelum prevSibling. Ini dapat dilakukan jika bukan pertanyaan pertama
        questions.insertBefore(questionBox, prevSibling)
    }
    // fitur geser bawah
    if (e.target.className == "down-btn" && nextSibling != null) {
        // pindah next sibling question box ke sebelum question box. Lakukan ini hanya jika bukan pertanyaan terakhir
        questions.insertBefore(nextSibling, questionBox)
    }
    // fitur ubah tipe jawaban
    if (e.target.className == "select") {
        e.target.addEventListener("change", function() {
            // jalankan kode jika state select berubah
            // ambil class answer
            const answer = e.target.parentElement.previousElementSibling
            // kalo milih jawaban singkat
            if (e.target.value == "Jawaban Singkat") {
                answer.innerHTML = `
                    <input type="text" name="answer`+ answerCount +`" class="answer" value="Jawaban singkat" readonly>
                `;
            }
            // kalo milih pilihan ganda
            else if (e.target.value == "Pilihan Ganda") {
                optionCount++
                answer.innerHTML = `
                    <div class="kontainer-pilihan">
                        <div>
                            <input type="radio" class="answerChoiceButton" placeholder="Your answer" disabled>
                            <input type="text" name="option`+ optionCount +`" class="answerChoice" placeholder="option">
                        </div>
                    </div>
                    <a href="" class="add-option">add option</a>
                `;
            }
        })
    }
    // fitur tambah opsi pada pilihan ganda
    if (e.target.className == "add-option") {
        optionCount++
        const opsiBaru = document.createElement("div")
        opsiBaru.innerHTML = `
            <input type="radio" class="answerChoiceButton" placeholder="Your answer" disabled>
            <input type="text" name="option`+ optionCount +`" class="answerChoice" placeholder="option">
            <a href="" class="del-option">X</a>
        `;
        // tambah child kontainer pilihan, opsi
        e.target.previousElementSibling.appendChild(opsiBaru)
        // biar link pas dipencet ngga reload page
        e.preventDefault()
    }
    // fitur hapus opsi pada pilihan ganda
    if (e.target.className == "del-option") {
        e.target.parentElement.remove()
        e.preventDefault()
    }
    // fitur tambah img
    if (e.target.className == "fa-regular fa-image") {
        // tambah event listener ke input file
        e.target.parentElement.previousElementSibling.addEventListener("change", function(event) {
            // ambil div buat preview img
            let imageDiv = e.target.parentElement.nextElementSibling
            imageDiv.innerHTML = ""

            // bikin img
            let newImg = document.createElement("img")
            let image = URL.createObjectURL(event.target.files[0])
            newImg.src = image
            newImg.width = 300

            // bikin tombol close
            const a = document.createElement("a")
            a.href = ""
            a.classList.add("del-img")
            a.innerHTML = "X"

            imageDiv.appendChild(newImg)
            imageDiv.appendChild(a)
        })
    }
    // fitur hapus img
    if (e.target.className == "del-img") {
        e.target.parentElement.innerHTML = ""
        e.preventDefault()
    }
})