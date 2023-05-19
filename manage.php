<!DOCTYPE html>
<html>

<head>
    <title>Manage</title>

    <style>
        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Manage</h1>

    <!-- change tab -->
    <a class="btnTab" href="manage.php">Manage</a>
    <a class="btnTab" href="form.php">Fill</a>
    <a class="btnTab" href="result.php">Result</a>

    <!-- table manage (short answer) -->
    <form>
    <table>
      <tr>
        <td>Pertanyaan ...</td>
        <td><select id="quest_type">
          <option value="choice">Pilihan ganda</option>
          <option value="short">Jawaban singkat</option>
        </select></td>
      </tr>
      <tr>
        <td><input id="answer" type="text"></td>
      </tr>
      <tr>
        <td><a>geser atas</a></td>
        <td><a>geser bawah</a></td>
        <td><a>hapus</a></td>
      </tr>
    </table>

    <!-- table manage (pilihan) -->
    <table>
      <tr>
        <td>Pertanyaan ...</td>
        <td><select id="quest_type">
          <option value="choice">Pilihan ganda</option>
          <option value="short">Jawaban singkat</option>
        </select></td>
      </tr>
      <tr>
        <td>
          <input type="radio" id="pil1" name="pilihan" value="a">
          <label for="pil1">pilihan 1</label><br>
          <input type="radio" id="pil2" name="pilihan" value="b">
          <label for="pil2">pilihan 2</label><br>
          <input type="radio" id="pil3" name="pilihan" value="c">
          <label for="pil3">pilihan 3</label><br>
        </td>
      </tr>
      <tr>
        <td><a>geser atas</a></td>
        <td><a>geser bawah</a></td>
        <td><a>hapus</a></td>
      </tr>
    </table>
    </form>
</body>

</html>