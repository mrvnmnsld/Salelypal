const imageUpload = document.getElementById('imageUpload')
const imageUpload2 = document.getElementById('imageUpload2')

Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('assets/lib/faceapi/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('assets/lib/faceapi/models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('assets/lib/faceapi/models')
]).then(start)

async function start() {
  const container = document.createElement('div')
  container.style.position = 'relative'
  document.body.append(container)
  // const labeledFaceDescriptors = await loadLabeledImages()

  

  let image
  let canvas
  document.body.append('Loaded')
  imageUpload.addEventListener('change', async () => {
    image2 = await faceapi.bufferToImage(imageUpload2.files[0]);
    image2Detections = await faceapi.detectAllFaces(image2).withFaceLandmarks().withFaceDescriptors()

    const faceMatcher = new faceapi.FaceMatcher(image2Detections, 0.6)
    

    if (image) image.remove()
    if (canvas) canvas.remove()

    image = await faceapi.bufferToImage(imageUpload.files[0])
    container.append(image)
    canvas = faceapi.createCanvasFromMedia(image)
    container.append(canvas)

    
    const displaySize = { width: image.width, height: image.height }
    
    faceapi.matchDimensions(canvas, displaySize)
    const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
    const resizedDetections = faceapi.resizeResults(detections, displaySize)

    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))

    console.log(results);

    results.forEach((result, i) => {
      const box = resizedDetections[i].detection.box
      const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
      drawBox.draw(canvas)
    })
  })
}

function loadLabeledImages() {
  const labels = ['Black Widow', 'Captain America', 'Captain Marvel', 'Hawkeye', 'Jim Rhodes', 'Thor', 'Tony Stark', 'Marvin Monsalud']
  return Promise.all(
    labels.map(async label => {
      const descriptions = []
      // for (let i = 1; i <= 2; i++) {
        const img = await faceapi.fetchImage(`labeled_images/${label}/1.jpg`)
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor)
      // }

      return new faceapi.LabeledFaceDescriptors(label, descriptions)
    })
  )
}
