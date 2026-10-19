const express = require('express');
const app = express();
const PORT = 3000;
app.use(express.json());

// Practical 5: PHP will call this Express REST endpoint.
app.get('/api/message', (req, res) => {
  res.json({ success: true, message: 'Hello from Express REST API!', source: 'Node.js + Express', port: PORT });
});

// Practical 6: Express calls this PHP REST endpoint and displays its response.
app.get('/call-php-api', async (req, res) => {
  const phpUrl = 'http://localhost/php_shopping_cart/practicals/api/students.php';
  try {
    const response = await fetch(phpUrl);
    const bodyText = await response.text();
    let data;
    try { data = JSON.parse(bodyText); }
    catch { return res.status(502).json({ success: false, error: 'PHP did not return JSON. Check Apache, PHP URL, and PHP errors.', response: bodyText.slice(0, 500) }); }
    if (!response.ok) return res.status(502).json({ success: false, phpStatus: response.status, phpResponse: data });
    return res.json({ success: true, message: 'Express successfully called the PHP REST API.', phpApiUrl: phpUrl, data });
  } catch (error) {
    return res.status(502).json({ success: false, error: 'Could not reach PHP API. Start Apache and check the URL.', details: error.message });
  }
});

app.listen(PORT, () => console.log(`Express API running at http://localhost:${PORT}`));
