import { Component, OnInit } from '@angular/core';
import { nurseService } from '../service/nurse.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
  providers: [nurseService]
})
export class LoginComponent implements OnInit {
  constructor(private nurseService: nurseService) { }

  // nurses: Nurse[] = jsonData;
  nurses: (<Nurse>() => []) | null = null;
  ngOnInit() {
    this.nurseService.getAll()
      .subscribe(data => {
        console.log(data)
      });
  }
  login() {
    this.nurseService.login();
  }
  get form() {
    return this.nurseService.form;
  }
}
