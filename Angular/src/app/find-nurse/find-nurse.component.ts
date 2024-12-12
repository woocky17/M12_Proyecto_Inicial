import { Component, ElementRef, ViewChild, AfterViewInit } from '@angular/core';
import { nurseService } from '../service/antonio.service';

@Component({
  selector: 'app-find-nurse',
  templateUrl: './find-nurse.component.html',
  styleUrl: './find-nurse.component.css',
  providers: [nurseService]
})

export class FindNurseComponent {

  constructor(private nurseService: nurseService) { }
  findNurse() {
    this.nurseService.findNurse();
  }
}

class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
}