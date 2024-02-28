using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class CameraController : MonoBehaviour
{
    //pozycja gracza
    Transform player;
    //offset kamery
    Vector3 cameraOffset;
    //predkosc przesuwania kamery
    Vector3 cameraSpeed;
    //czas wyg³adzania ruchu kamery
    float smoothTime = 0.3f;

    // Start is called before the first frame update
    void Start()
    {
        //znajdz gracza i pod³¹cz jego pozycjê do zmiennej transform
        player = GameObject.FindGameObjectWithTag("Player").transform;
        //pobierz domyslny offset kamery
        cameraOffset = transform.position - player.position; 
    }

    // Update is called once per frame
    void FixedUpdate()
    {
        //pozycja kamery to pozycja gracza + offset
        //transform.position = player.position + cameraOffset;

        //bardziej kulturalnie
        Vector3 targetPosition = player.position + cameraOffset; 
        //transform.position = Vector3.Lerp(transform.position, targetPosition, Time.deltaTime);
        transform.position = Vector3.SmoothDamp(transform.position, targetPosition, ref cameraSpeed, smoothTime);
    }
}
