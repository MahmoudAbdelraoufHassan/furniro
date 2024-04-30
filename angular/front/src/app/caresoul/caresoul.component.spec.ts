import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CaresoulComponent } from './caresoul.component';

describe('CaresoulComponent', () => {
  let component: CaresoulComponent;
  let fixture: ComponentFixture<CaresoulComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CaresoulComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CaresoulComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
