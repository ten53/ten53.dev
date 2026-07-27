import * as THREE from 'three'

// ============================================================================
//*** Scene Setup
// ============================================================================

// Grab the canvas from the page
const canvas = document.querySelector('#webgl')

// Create the scene.
// The scene is the "world" that contains everything we render.
const scene = new THREE.Scene()

// ============================================================================
//*** Camera
// ============================================================================

// Perspective camera:
// - fov   = field of view (degrees)
// - aspect = width / height of the canvas
// - near/far = clipping planes
const camera = new THREE.PerspectiveCamera(
    75,
    canvas.clientWidth / canvas.clientHeight,
    0.01,
    100
)

// Move the camera backwards so we can see the origin.
camera.position.set(0, 0, 3)

// Always point the camera at the center of the scene.
camera.lookAt(0, 0, 0)

scene.add(camera)

// ============================================================================
//*** Renderer
// ============================================================================

// The renderer draws the scene onto our canvas.
const renderer = new THREE.WebGLRenderer({
    canvas,
    antialias: true,
})

// Match the renderer to the canvas size.
renderer.setSize(canvas.clientWidth, canvas.clientHeight)

// Limit pixel ratio for performance on Retina displays.
renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))

// ============================================================================
//*** Resize Handling
// ============================================================================

// Keep the renderer and camera in sync when the canvas changes size.
window.addEventListener('resize', () => {
    const width = canvas.clientWidth
    const height = canvas.clientHeight

    camera.aspect = width / height
    camera.updateProjectionMatrix()

    renderer.setSize(width, height, false)
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2))
})

// ============================================================================
//*** Objects
// ============================================================================

// Create a simple cube.
const cube = new THREE.Mesh(
    new THREE.BoxGeometry(1, 1, 1),
    new THREE.MeshBasicMaterial()
)

scene.add(cube)

// Axes Helper
// Makes it much easier to understand the coordinate system.
//
// Red   = X
// Green = Y
// Blue  = Z
//
// const axesHelper = new THREE.AxesHelper(2)
// scene.add(axesHelper)

// ============================================================================
//*** Animation Loop
// ============================================================================

// This function runs once every frame (~60 fps).
function animate() {

    // Example animation.
    // cube.rotation.y += 0.01

    renderer.render(scene, camera)

    requestAnimationFrame(animate)
}

animate()
